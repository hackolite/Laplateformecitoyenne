"""App entry point."""
from flask_login_tutorial import create_app
import os
from flask_cors import CORS

app = create_app()
CORS(app)
SECRET_KEY = os.urandom(32)
app.config['SECRET_KEY'] = SECRET_KEY

if __name__ == "__main__":
    app.run(host='0.0.0.0', debug=True)
