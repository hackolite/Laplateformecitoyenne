import connexion
import six

from swagger_server.models.entity import Entity  # noqa: E501
from swagger_server import util


def add_entity():  # noqa: E501
    """Add a new entity

     # noqa: E501


    :rtype: None
    """
    return 'do some magic!'


def delete_entity(entityId, api_key=None):  # noqa: E501
    """Deletes an entity

     # noqa: E501

    :param entityId: Entity id to delete
    :type entityId: int
    :param api_key: 
    :type api_key: str

    :rtype: None
    """
    return 'do some magic!'


def find_entitites_by_status(status):  # noqa: E501
    """Finds entity by status

    Multiple status values can be provided with comma separated strings # noqa: E501

    :param status: Status values that need to be considered for filter
    :type status: List[str]

    :rtype: None
    """
    return 'do some magic!'


def find_entity_by_tags(tags):  # noqa: E501
    """Finds Entities by tags

    Muliple tags can be provided with comma separated strings. Use tag1, tag2, tag3 for testing. # noqa: E501

    :param tags: Tags to filter by
    :type tags: List[str]

    :rtype: None
    """
    return 'do some magic!'


def get_entity_by_id(entityId):  # noqa: E501
    """Find entity by ID

    Returns a single pet # noqa: E501

    :param entityId: ID of pet to return
    :type entityId: int

    :rtype: Entity
    """
    return 'do some magic!'


def update_entity():  # noqa: E501
    """Update an existing entity

     # noqa: E501


    :rtype: None
    """
    return 'do some magic!'


def update_entity_with_form(entityId, name=None, status=None):  # noqa: E501
    """Updates a entity in the store with form data

     # noqa: E501

    :param entityId: ID of Entity that needs to be updated
    :type entityId: int
    :param name: Updated name of the entity
    :type name: str
    :param status: Updated status of the entity
    :type status: str

    :rtype: None
    """
    return 'do some magic!'
