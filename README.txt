Develop a general purpose REST API framework that offers:

- Uniform way of handling HTTP Requests and Responses to save the
application developer time
- Way of dispatching actions from a specified URL, AKA URL Routing
- Support for HTTP Basic authentication (optional)


POST Example

curl -d "param1=value1&username=USERNAME" http://localhost/framework/contact
<h1>New</h1><p>Contact ID: </p><pre>Array
(
    [param1] => value1
    [username] => USERNAME
)
</pre>