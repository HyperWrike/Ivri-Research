FROM nginx:alpine

RUN apk add --no-cache php83-fpm php83-mysqli php83-mbstring php83-curl php83-xml

COPY nginx.conf /etc/nginx/conf.d/default.conf

COPY . /usr/share/nginx/html

EXPOSE 80

CMD php-fpm83 -D && nginx -g "daemon off;"
