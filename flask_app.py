# This file is used for hosting at PythonAnywhere.com
# 'app' must point to a Flask Application object.
from flask_sslify import SSLify

from app import create_app
context = ('web.crt', 'web.key')

app=create_app(ssl_context=context)
# app.config['CORS_HEADERS'] = 'Content-Type'

sslify=SSLify(app)
