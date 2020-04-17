# coding: utf-8

from __future__ import absolute_import

from flask import json
from six import BytesIO

from swagger_server.models.chat import Chat  # noqa: E501
from swagger_server.test import BaseTestCase


class TestChatController(BaseTestCase):
    """ChatController integration test stubs"""

    def test_create_chat(self):
        """Test case for create_chat

        Place an order for a pet
        """
        body = Chat()
        response = self.client.open(
            '/v2/chat',
            method='POST',
            data=json.dumps(body),
            content_type='application/json')
        self.assert200(response,
                       'Response body is : ' + response.data.decode('utf-8'))

    def test_delete_order(self):
        """Test case for delete_order

        Delete chat by ID
        """
        response = self.client.open(
            '/v2/chat/{orderId}'.format(orderId=2),
            method='DELETE')
        self.assert200(response,
                       'Response body is : ' + response.data.decode('utf-8'))

    def test_get_inventory(self):
        """Test case for get_inventory

        Returns chat inventories by status
        """
        response = self.client.open(
            '/v2/chat/inventory',
            method='GET')
        self.assert200(response,
                       'Response body is : ' + response.data.decode('utf-8'))

    def test_get_order_by_id(self):
        """Test case for get_order_by_id

        Find purchase order by ID
        """
        response = self.client.open(
            '/v2/chat/{orderId}'.format(orderId=10),
            method='GET')
        self.assert200(response,
                       'Response body is : ' + response.data.decode('utf-8'))


if __name__ == '__main__':
    import unittest
    unittest.main()
