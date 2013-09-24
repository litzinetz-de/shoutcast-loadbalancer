Shoutcast Loadbalancer
======================

This PHP-script allows dynamic load balancing between two or more shoutcast servers.

When a user connects, it querys all the configured servers to get that one which has the most slots available. The script will then return the ip address of that server, which can be handled by your software in any further way, usually for connecting the user to the server.

If two servers have the same count of slots available, the script will return the first in the list.