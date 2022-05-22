# REST API Posts Manager
# REST API

The Rest API to control CRUD flow in a post storage system.

## Get list of posts

### Request

`GET /posts/`

    curl -i -H 'www-x-form-urlencoded' http://localhost:8000/posts/

### Response

    HTTP/1.1 200 OK
    Date: Sun, 21 May 2022 12:36:30 GMT
    Status: 200 OK
    Connection: close
    Content-Type: application/json
    Content-Length: int

    []
    
## Create a new Post

### Request

`POST /posts/`

    curl -i -H 'www-x-form-urlencoded' http://localhost:8000/posts
    body:
    ?title="Dracula"&author="Bram%Stoker"&content="post-content"&tags="["Horror%Gótico","Romance%epistolar"]"
    *Required: title, author.
    

### Response

    HTTP/1.1 201 Created
    Date: Sun, 21 May 2022 12:36:30 GMT
    Status: 201 Created
    Connection: close
    Content-Type: application/json
    Content-Length: int

    {
    "title": "Dracula",
    "author": "Bram Stoker",
    "content": "No século 15, a Igreja se recusa a enterrar em solo sagrado a grande paixão do líder dos Cárpatos que decide, então, renegar a instituição          religiosa. Ele passa a perambular através dos séculos até encontrar a suposta reencarnação de sua amada.",
    "tags": "[\"Horror Gótico\", \"Romance epistolar\"]",
    "id": 1
    }
    
    
## Get list of posts again

### Request

`GET /posts/`

    curl -i -H 'www-x-form-urlencoded' http://localhost:8000/posts/

### Response

    HTTP/1.1 200 OK
    Date: Sun, 21 May 2022 12:36:30 GMT
    Status: 200 OK
    Connection: close
    Content-Type: application/json
    Content-Length: int
    
    [
    {
    "id": 1,
    "title": "Dracula",
    "author": "Bram Stoker",
    "content": "No século 15, a Igreja se recusa a enterrar em solo sagrado a grande paixão do líder dos Cárpatos que decide, então, renegar a instituição          religiosa. Ele passa a perambular através dos séculos até encontrar a suposta reencarnação de sua amada.",
    "tags": "[\"Horror Gótico\", \"Romance epistolar\"]"
    }
    ]
    
## Create a duplicate title post

### Request

`POST /posts/`

    curl -i -H 'www-x-form-urlencoded' http://localhost:8000/posts
    body:
    ?title="Dracula"&author="Bram%Stoker"&content="post-content"&tags="["Horror%Gótico","Romance%epistolar"]"
    *Required: title, author.
    

### Response

    HTTP/1.1 422 error
    Date: Sun, 21 May 2022 12:36:30 GMT
    Status: 422 The given data was invalid.
    Connection: close
    Content-Type: application/json
    Content-Length: int

    {
    "message": "The given data was invalid.",
    "errors": {
        "title": [
            "The title has already been taken."
        ]
    }
    }
    
    
## Update a post

### Request

`PUT /posts/:id`

    curl -i -H 'www-x-form-urlencoded' -X PUT http://localhost:8000/posts/1
    body:
    ?title='Drácula'
### Response

    HTTP/1.1 200 OK
    Date: Thu, 24 Feb 2011 12:36:31 GMT
    Status: 200 OK
    Connection: close
    Content-Type: application/json
    Content-Length: 40

    {
    "title": "Drácula",
    "author": "Bram Stoker",
    "content": "No século 15, a Igreja se recusa a enterrar em solo sagrado a grande paixão do líder dos Cárpatos que decide, então, renegar a instituição          religiosa. Ele passa a perambular através dos séculos até encontrar a suposta reencarnação de sua amada.",
    "tags": "[\"Horror Gótico\", \"Romance epistolar\"]",
    "id": 1
    }
    
## Update a non existing post
### Request

`PUT /posts/:id`

    curl -i -H 'www-x-form-urlencoded' -X PUT http://localhost:8000/posts/100
    body:
    ?title='Drácula'
    
### Response

    HTTP/1.1 404 error
    Date: Thu, 24 Feb 2011 12:36:31 GMT
    Status: 404 Route not found.
    Connection: close
    Content-Type: application/json
    Content-Length: int
    
    {
    "error:": "Route not found. Update failed"
    }
    
