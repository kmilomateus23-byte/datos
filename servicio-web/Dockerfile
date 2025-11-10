# Usar imagen base con PHP y Nginx
FROM richarvey/nginx-php-fpm:3.1.6
COPY . .
RUN apk update
# Opcional: instalar npm si usas Vite u otros assets
RUN apk add --no-cache npm
RUN npm install
RUN npm run build
CMD ["/start.sh"]
