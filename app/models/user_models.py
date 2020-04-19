# Copyright 2014 SolidBuilds.com. All rights reserved
#
# Authors: Ling Thio <ling.thio@gmail.com>

from flask_user import UserMixin
# from flask_user.forms import RegisterForm
from flask_wtf import FlaskForm
from wtforms import StringField, SubmitField, validators,IntegerField
from app import db
from sqlalchemy.dialects.postgresql import UUID
from flask_sqlalchemy import SQLAlchemy
import uuid
from sqlalchemy_utils import UUIDType


# Define the User data model. Make sure to add the flask_user.UserMixin !!
class User(db.Model, UserMixin):
    __tablename__ = 'users'
    id = db.Column(db.Integer, primary_key=True)

    # User authentication information (required for Flask-User)
    email = db.Column(db.Unicode(255), nullable=False, server_default=u'', unique=True)
    email_confirmed_at = db.Column(db.DateTime())
    password = db.Column(db.String(255), nullable=False, server_default='')
    # reset_password_token = db.Column(db.String(100), nullable=False, server_default='')
    active = db.Column(db.Boolean(), nullable=False, server_default='0')

    # User information
    active = db.Column('is_active', db.Boolean(), nullable=False, server_default='0')
    first_name = db.Column(db.Unicode(50), nullable=False, server_default=u'')
    last_name = db.Column(db.Unicode(50), nullable=False, server_default=u'')

    # Relationships
    roles = db.relationship('Role', secondary='users_roles',
                            backref=db.backref('users', lazy='dynamic'))
    latitude = db.Column(db.Float)
    longitude = db.Column(db.Float)
    type = db.Column(db.Unicode(50), nullable=False, server_default=u'')
    fabricMask = db.Column(db.Integer)
    surgicalMask = db.Column(db.Integer)
    constructionMask = db.Column(db.Integer)
    glasses = db.Column(db.Integer)
    blouse = db.Column(db.Integer)
    visor = db.Column(db.Integer)
    chatuuid =  db.Column(UUIDType(binary=False), unique=True)

    @property
    def serialize(self):
       """Return object data in easily serializable format"""
       return {
            'id': self.id,
            'email': self.email,
            'email_confirmed_at': self.email_confirmed_at,
            'password': self.password,
            'active':self.active,
            'first_name': self.first_name,
            'last_name': self.last_name,
            'latitude': self.latitude,
            'longitude':self.longitude,
            'type': self.type,
            'fabricMask': self.fabricMask,
            'surgicalMask': self.surgicalMask,
            'constructionMask': self.constructionMask,
            'glasses': self.glasses,
            'blouse': self.blouse,
            'visor': self.visor,
            'chatuuid': self.chatuuid
       }




class Marker(db.Model):
    __tablename__ = 'marker'
    id = db.Column(db.Integer, primary_key=True)
    latitude = db.Column(db.Float)
    longitude = db.Column(db.Float)
    type = db.Column(db.Unicode(50), nullable=False, server_default=u'')
    fabricMask = db.Column(db.Integer)
    surgicalMask = db.Column(db.Integer)
    constructionMask = db.Column(db.Integer)
    glasses = db.Column(db.Integer)
    blouse = db.Column(db.Integer)
    visor = db.Column(db.Integer)
    user_id = db.Column(db.Integer, db.ForeignKey('users.id', ondelete='CASCADE'))


# Define the Role data model
class Role(db.Model):
    __tablename__ = 'roles'
    id = db.Column(db.Integer(), primary_key=True)
    name = db.Column(db.String(50), nullable=False, server_default=u'', unique=True)  # for @roles_accepted()
    label = db.Column(db.Unicode(255), server_default=u'')  # for display purposes


# Define the UserRoles association model
class UsersRoles(db.Model):
    __tablename__ = 'users_roles'
    id = db.Column(db.Integer(), primary_key=True)
    user_id = db.Column(db.Integer(), db.ForeignKey('users.id', ondelete='CASCADE'))
    role_id = db.Column(db.Integer(), db.ForeignKey('roles.id', ondelete='CASCADE'))



# Define the User profile form
class UserProfileForm(FlaskForm):
    first_name = StringField('First name', validators=[
        validators.DataRequired('First name is required')])
    last_name = StringField('Last name', validators=[
        validators.DataRequired('Last name is required')])
    submit = SubmitField('Save')



# Define the User profile form
class UserNeedForm(FlaskForm):
    type = StringField('Type',[validators.DataRequired()], render_kw={"placeholder": "Medical or Maker"})
    town = StringField('Ville',[validators.DataRequired()], render_kw={"placeholder": "Ville"})
    fabricMask = IntegerField('Masque en tissu',[validators.InputRequired("You have to enter some a number")], render_kw={"placeholder": "Nombre"})
    surgicalMask = IntegerField('Masque chirugical', [validators.InputRequired("You have to enter some a number")], render_kw={"placeholder": "Nombre"})
    constructionMask = IntegerField('Masque de chantier', [validators.InputRequired("You have to enter some a number")],render_kw={"placeholder": "Nombre"})
    glasses = IntegerField('Lunettes', [validators.InputRequired("You have to enter some a number")],render_kw={"placeholder": "Nombre"})
    blouse = IntegerField('Blouse', [validators.InputRequired("You have to enter some a number")],render_kw={"placeholder": "Nombre"})
    visor = IntegerField('Visière',[validators.InputRequired("You have to enter some a number")], render_kw={"placeholder": "Nombre"})

    submit = SubmitField('Save')
