FROM php:8.1-fpm

# Atualiza os pacotes e instala as dependências necessárias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    git \
    curl \
    unzip \
    netcat-traditional \
    && docker-php-ext-install zip pdo pdo_mysql

# Define o diretório de trabalho
WORKDIR /app

# Baixa e instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia apenas os arquivos de composição do Laravel (composer.json e composer.lock) primeiro
# Isso melhora o cache das camadas do Docker se suas dependências não mudarem
COPY composer.json composer.lock /app/

# Instala as dependências do Composer, sem os scripts e dev-dependências para produção
# A opção --no-cache é usada para evitar problemas com cache de pacotes do Composer
RUN composer install --no-scripts --no-dev --prefer-dist --no-cache

# Copia o restante dos arquivos do projeto
COPY . /app

# Altera as permissões da pasta storage e bootstrap/cache
RUN chmod -R 775 /app/storage /app/bootstrap/cache

# Copia o script de inicialização para o container
COPY start.sh /app

# Define o ponto de entrada ou comandos específicos se necessário
# (por exemplo, para iniciar o servidor Laravel ou executar migrações)
