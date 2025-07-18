# ベースイメージはPHP 8.1-apache版を使用
FROM php:8.1-apache

# 必要なパッケージのインストール
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libcurl4-openssl-dev \
    libxml2-dev

# PHP拡張モジュールのインストール
RUN docker-php-ext-install curl xml
RUN docker-php-ext-install curl xml pdo_mysql

# Composerのインストール
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Laravelのインストーラをグローバルにインストール
RUN composer global require laravel/installer

# グローバルにインストールしたパッケージのbinディレクトリを絶対パスで設定
RUN composer global config bin-dir --absolute

# ComposerのbinディレクトリをPATHに追加（以降のRUN命令やコンテナ起動時に有効）
ENV PATH="${PATH}:/root/.config/composer/vendor/bin"

# Laravelプロジェクトのインストール（/var/www/html/laravel_app に作成）
RUN composer create-project --prefer-dist laravel/laravel:^10.0 /var/www/html/laravel_app

# DocumentRootを laravel_app/public に変更（Apache設定の上書き）
RUN rm /etc/apache2/sites-available/000-default.conf && \
    echo '<VirtualHost *:80>\n\
    ServerAdmin webmaster@localhost\n\
    DocumentRoot /var/www/html/laravel_app/public\n\
    <Directory /var/www/html/laravel_app/public>\n\
    AllowOverride All\n\
    Require all granted\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
    </VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Apache mod_rewrite 有効化
RUN a2enmod rewrite

# Apache設定ファイルを上書きする
COPY ../php/000-default.conf /etc/apache2/sites-available/000-default.conf
