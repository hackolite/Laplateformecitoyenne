import connexion
import six

from swagger_server.models.chat import Chat  # noqa: E501
from swagger_server import util


def create_chat(body):  # noqa: E501
    """Place an order for a pet

     # noqa: E501

    :param body: order placed for purchasing the pet
    :type body: dict | bytes

    :rtype: Chat
    """
    if connexion.request.is_json:
        body = Chat.from_dict(connexion.request.get_json())  # noqa: E501
    return 'do some magic!'


def delete_order(orderId):  # noqa: E501
    """Delete chat by ID

    For valid response try integer IDs with positive integer value.         Negative or non-integer values will generate API errors # noqa: E501

    :param orderId: ID of the chat  that needs to be deleted
    :type orderId: int

    :rtype: None
    """
    return 'do some magic!'


def get_inventory():  # noqa: E501
    """Returns chat inventories by status

    Returns a map of status codes to quantities # noqa: E501


    :rtype: Dict[str, int]
    """
    return 'do some magic!'


def get_order_by_id(orderId):  # noqa: E501
    """Find purchase order by ID

    For valid response try integer IDs with value &gt;&#x3D; 1 and &lt;&#x3D; 10.         Other values will generated exceptions # noqa: E501

    :param orderId: ID of chat that needs to be fetched
    :type orderId: int

    :rtype: Chat
    """
    return 'do some magic!'
