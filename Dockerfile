FROM php:8.1-fpm

# Atualiza os pacotes e instala as dependências necessárias
# Além de libzip-dev e zip, pdo e pdo_mysql, adiciona git, curl e unzip que são frequentemente necessários
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    git \
    curl \
    unzip \
    && docker-php-ext-install zip pdo pdo_mysql

# Define o diretório de trabalho
WORKDIR /app

# Copia apenas os arquivos de composição do Laravel (composer.json e composer.lock) primeiro
# Isso melhora o cache das camadas do Docker se suas dependências não mudarem
COPY composer.json composer.lock /app/

# Baixa e instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala as dependências do Composer, sem os scripts e dev-dependências para produção
RUN composer install --no-scripts --no-dev --prefer-dist

# Copia o restante dos arquivos do projeto
COPY . /app

# Altera as permissões da pasta storage e bootstrap/cache
RUN chmod -R 775 /app/storage /app/bootstrap/cache

# Copia o script de inicialização para o container
COPY start.sh /app

# Define o ponto de entrada ou comandos específicos se necessário
# (por exemplo, para iniciar o servidor Laravel ou executar migrações)
