FROM dell/lamp-base:1.1
MAINTAINER Dell Cloud Market Place <Cloud_Marketplace@dell.com>

# Add image configuration and scripts
COPY run.sh /run.sh
RUN chmod 755 run.sh

# Remove any pre-installed applications
RUN rm -fr /var/www/html/*

# Add the folder with the sample application
COPY /Management _service /var/www/html/uet

# Add volumes for MySQL and the application.
RUN chmod +x /var/www/html/Management _service -R
VOLUME ["/var/lib/mysql", "/var/www/html"]

EXPOSE 80 3306 443

CMD ["/run.sh"]
