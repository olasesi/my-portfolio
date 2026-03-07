FROM php:8.2-apache

# ── System dependencies ───────────────────────────────────
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libwebp-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libssl-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# ── PHP extensions ────────────────────────────────────────
RUN docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_mysql \
        mysqli \
        gd \
        zip \
        mbstring \
        xml \
        bcmath \
        opcache

# ── Apache modules ────────────────────────────────────────
# mod_rewrite  → clean URLs / .htaccess rewrites
# mod_headers  → security headers (X-Frame-Options, etc.)
# mod_expires  → browser caching
# mod_deflate  → gzip compression
RUN a2enmod rewrite headers expires deflate

# ── Apache: allow .htaccess overrides in document root ───
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' \
        /etc/apache2/sites-available/000-default.conf \
    && sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' \
        /etc/apache2/apache2.conf \
    && echo '<Directory /var/www/html/public>\n\
    Options -Indexes +FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf

# ── PHP config: development settings ─────────────────────
RUN cp "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" \
    && sed -i 's/display_errors = Off/display_errors = On/' "$PHP_INI_DIR/php.ini" \
    && sed -i 's/error_reporting = .*/error_reporting = E_ALL/' "$PHP_INI_DIR/php.ini" \
    && sed -i 's/upload_max_filesize = .*/upload_max_filesize = 64M/' "$PHP_INI_DIR/php.ini" \
    && sed -i 's/post_max_size = .*/post_max_size = 64M/' "$PHP_INI_DIR/php.ini" \
    && sed -i 's/memory_limit = .*/memory_limit = 256M/' "$PHP_INI_DIR/php.ini" \
    && sed -i 's/max_execution_time = .*/max_execution_time = 120/' "$PHP_INI_DIR/php.ini"

# ── Composer ──────────────────────────────────────────────
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ── Working directory ─────────────────────────────────────
WORKDIR /var/www/html

# ── Copy project files ────────────────────────────────────
COPY . .

# ── Install Composer dependencies (if composer.json exists)
RUN if [ -f composer.json ]; then \
        composer install --no-interaction --prefer-dist --optimize-autoloader; \
    fi

# ── Permissions ───────────────────────────────────────────
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80