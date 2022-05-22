# REST API Posts Manager
# REST API

The Rest API to control CRUD flow in a post storage system.

## Get list of posts

### Request

`GET /posts/`

    curl -i -H http://localhost:8000/posts/

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

    curl -i -H 'application/json' http://localhost:8000/posts
    {
    "title": "Dracula",
    "author": "Bram Stoker",
    "content": "No século 15, a Igreja se recusa a enterrar em solo sagrado a grande paixão do líder dos Cárpatos que decide, então, renegar a instituição              religiosa. Ele passa a perambular através dos séculos até encontrar a suposta reencarnação de sua amada.",
    "tags":["Horror Gótico", "Romance epistolar"]
    }
    

### Response

    HTTP/1.1 201 Created
    Date: Sun, 21 May 2022 12:36:30 GMT
    Status: 201 Created
    Connection: close
    Content-Type: application/json
    Content-Length: int

    [
    {
        "title": "Dracula",
        "author": "Bram Stoker",
        "content": "No século 15, a Igreja se recusa a enterrar em solo sagrado a grande paixão do líder dos Cárpatos que decide, então, renegar a instituição              religiosa. Ele passa a perambular através dos séculos até encontrar a suposta reencarnação de sua amada.",
        "tags": [
            "Horror Gótico",
            "Romance epistolar"
        ],
        "id": 1
    }
    ]
    
    
## Get list of posts again

### Request

`GET /posts/`

    curl -i -H 'application/json' http://localhost:8000/posts/

### Response

    HTTP/1.1 200 OK
    Date: Sun, 21 May 2022 12:36:30 GMT
    Status: 200 OK
    Connection: close
    Content-Type: application/json
    Content-Length: int
    
    [
    {
        "id": 19,
        "title": "Dracula",
        "author": "Bram Stoker",
        "content": "No século 15, a Igreja se recusa a enterrar em solo sagrado a grande paixão do líder dos Cárpatos que decide, então, renegar a instituição             religiosa. Ele passa a perambular através dos séculos até encontrar a suposta reencarnação de sua amada.",
        "tags": [
            "Horror Gótico",
            "Romance epistolar"
        ]
    }
    ]

## Get a specific Post

### Request

`GET /posts/{id}`

    curl -i -H 'Accept: application/json' http://localhost:8000/posts/1
    

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
        "content": "No século 15, a Igreja se recusa a enterrar em solo sagrado a grande paixão do líder dos Cárpatos que decide, então, renegar a instituição              religiosa. Ele passa a perambular através dos séculos até encontrar a suposta reencarnação de sua amada.",
        "tags": [
            "Horror Gótico",
            "Romance epistolar"
        ]
    }
    ]

## Get a non-existent Post

### Request

`GET /posts/{id}`

    curl -i -H 'Accept: application/json' http://localhost:8000/posts/25

### Response

    HTTP/1.1 404 Not Found
    Date: Sun, 21 May 2022 12:36:30 GMT
    Status: 404 Not Found
    Connection: close
    Content-Type: application/json
    Content-Length: int

    {
    "error:": "Route not found"
    }


## Get Posts by tag 

### Request

`GET /posts?tag=Horror`

    curl -i -H 'Accept: application/json' http://localhost:8000/posts?tag=Horror
    
    lists all posts with 'Horror' in "tags" array.

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
        "content": "No século 15, a Igreja se recusa a enterrar em solo sagrado a grande paixão do líder dos Cárpatos que decide, então, renegar a instituição              religiosa. Ele passa a perambular através dos séculos até encontrar a suposta reencarnação de sua amada.",
        "tags": [
            "Horror Gótico",
            "Romance epistolar"
        ]
    }
    ]

## Create a duplicate title post

### Request

`POST /posts/`

    curl -i -H 'application/json' http://localhost:8000/posts
    [
    {
        "title": "Dracula",
        "author": "Bram Stoker",
        "content": "No século 15, a Igreja se recusa a enterrar em solo sagrado a grande paixão do líder dos Cárpatos que decide, então, renegar a instituição              religiosa. Ele passa a perambular através dos séculos até encontrar a suposta reencarnação de sua amada.",
        "tags": [
            "Horror Gótico",
            "Romance epistolar"
        ],
        "id": 1
    }
    ]
    

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
    
    
## Update a existing post

### Request

`PUT /posts/{id}`

    curl -i -H 'application/json' -X PUT http://localhost:8000/posts/1
    
    {
    "title": "Drácula"
    }
    
### Response

    HTTP/1.1 200 OK
    Date: Sun, 21 May 2022 12:36:30 GMT
    Status: 200 OK
    Connection: close
    Content-Type: application/json
    Content-Length: int

    [
    {
        "title": "Drácula",
        "author": "Bram Stoker",
        "content": "No século 15, a Igreja se recusa a enterrar em solo sagrado a grande paixão do líder dos Cárpatos que decide, então, renegar a instituição              religiosa. Ele passa a perambular através dos séculos até encontrar a suposta reencarnação de sua amada.",
        "tags": [
            "Horror Gótico",
            "Romance epistolar"
        ],
        "id": 19
    }
    ]
    
## Update a non existing post
### Request

`PUT /posts/{id}`

    curl -i -H 'application/json' -X PUT http://localhost:8000/posts/25
    
    {
    "title": "Drácula"
    }
    
### Response

    HTTP/1.1 404 error
    Date: Sun, 21 May 2022 12:36:30 GMT
    Status: 404 Route not found.
    Connection: close
    Content-Type: application/json
    Content-Length: int
    
    {
    "error:": "Route not found. Update failed"
    }
    
## Delete a existing Post

### Request

`DELETE /thing/{id}`

    curl -i -H 'Accept: application/json' -X DELETE http://localhost:8000/posts/1/

### Response

    HTTP/1.1 200 OK
    Date: Sun, 21 May 2022 12:36:30 GMT
    Status: 200 OK
    Content-Type: application/json
    Connection: close
    
    {
    "msg:": "The post has been deleted succefully"
    }

## Try to delete a non existing Post

### Request

`DELETE /posts/{id}`

    curl -i -H 'Accept: application/json' -X DELETE http://localhost:8000/posts/25/

### Response

    HTTP/1.1 404 Not Found
    Date: Sun, 21 May 2022 12:36:30 GMT
    Status: 404 Not Found
    Connection: close
    Content-Type: application/json
    Content-Length: int

    {
    "error:": "Route not found. Delete failed"
    }
