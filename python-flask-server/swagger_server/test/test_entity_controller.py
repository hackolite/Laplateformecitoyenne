# coding: utf-8

from __future__ import absolute_import

from flask import json
from six import BytesIO

from swagger_server.models.entity import Entity  # noqa: E501
from swagger_server.test import BaseTestCase


class TestEntityController(BaseTestCase):
    """EntityController integration test stubs"""

    def test_add_entity(self):
        """Test case for add_entity

        Add a new entity
        """
        response = self.client.open(
            '/v2/entity',
            method='POST',
            content_type='application/json')
        self.assert200(response,
                       'Response body is : ' + response.data.decode('utf-8'))

    def test_delete_entity(self):
        """Test case for delete_entity

        Deletes an entity
        """
        headers = [('api_key', 'api_key_example')]
        response = self.client.open(
            '/v2/entity/{entityId}'.format(entityId=789),
            method='DELETE',
            headers=headers)
        self.assert200(response,
                       'Response body is : ' + response.data.decode('utf-8'))

    def test_find_entitites_by_status(self):
        """Test case for find_entitites_by_status

        Finds entity by status
        """
        query_string = [('status', 'available')]
        response = self.client.open(
            '/v2/entity/findByStatus',
            method='GET',
            query_string=query_string)
        self.assert200(response,
                       'Response body is : ' + response.data.decode('utf-8'))

    def test_find_entity_by_tags(self):
        """Test case for find_entity_by_tags

        Finds Entities by tags
        """
        query_string = [('tags', 'tags_example')]
        response = self.client.open(
            '/v2/entity/findByTags',
            method='GET',
            query_string=query_string)
        self.assert200(response,
                       'Response body is : ' + response.data.decode('utf-8'))

    def test_get_entity_by_id(self):
        """Test case for get_entity_by_id

        Find entity by ID
        """
        response = self.client.open(
            '/v2/entity/{entityId}'.format(entityId=789),
            method='GET')
        self.assert200(response,
                       'Response body is : ' + response.data.decode('utf-8'))

    def test_update_entity(self):
        """Test case for update_entity

        Update an existing entity
        """
        response = self.client.open(
            '/v2/entity',
            method='PUT',
            content_type='application/json')
        self.assert200(response,
                       'Response body is : ' + response.data.decode('utf-8'))

    def test_update_entity_with_form(self):
        """Test case for update_entity_with_form

        Updates a entity in the store with form data
        """
        data = dict(name='name_example',
                    status='status_example')
        response = self.client.open(
            '/v2/entity/{entityId}'.format(entityId=789),
            method='POST',
            data=data,
            content_type='application/x-www-form-urlencoded')
        self.assert200(response,
                       'Response body is : ' + response.data.decode('utf-8'))


if __name__ == '__main__':
    import unittest
    unittest.main()
