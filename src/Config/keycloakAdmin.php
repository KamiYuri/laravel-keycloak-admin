<?php

$baseAdminUrl = env('KEYCLOAK_ADMIN_BASE_URL','http://localhost:8080/auth/admin/realms/master');
$baseUrl = env('KEYCLOAK_BASE_URL', 'http://localhost:8080');
$realm = env('KEYCLOAK_REALM', 'master');

return [

    'client' => [
        'id' => env('KEYCLOAK_CLIENT_ID'),
        'secret' => env('KEYCLOAK_CLIENT_SECRET')
    ],

    'api' => [

        'client' => [

            'token' => "$baseUrl/realms/$realm/protocol/openid-connect/token",
            'user_token' => [
                'api' => "$baseUrl/realms/$realm/protocol/openid-connect/token",
                'method' => 'post'
            ],
            'create' => [
                'api' => "$baseAdminUrl/clients",
                'method' => 'post'
            ],
            'all' => [
                'api' => "$baseAdminUrl/clients",
                'method' => 'get'
            ],
            'get' => [
                'api' => "$baseAdminUrl/clients/{id}",
                'method' => 'get'
            ],
            'update' => [
                'api' => "$baseAdminUrl/clients/{id}",
                'method' => 'put'
            ],
            'delete' => [
                'api' => "$baseAdminUrl/clients/{id}",
                'method' => 'delete'
            ]

        ],


        'client_roles' => [

            'create' => [
                'api' => "$baseAdminUrl/clients/{id}/roles",
                'method' => 'post'
            ],
            'all' => [
                'api' => "$baseAdminUrl/clients/{id}/roles",
                'method' => 'get'
            ],
            'getByName' => [
                'api' => "$baseAdminUrl/clients/{id}/roles/{role}",
                'method' => 'get'
            ],
            'update' => [
                'update' => "$baseAdminUrl/clients/{id}/roles/{role}",
                'method' => 'post'
            ],
            'delete' => [
                'update' => "$baseAdminUrl/clients/{id}/roles/{role}",
                'method' => 'delete'
            ],

        ],


        'user' => [
            'create' => [
                'method' => 'post',
                'api' => "$baseAdminUrl/users"
            ],
            'find' => [
                'api' => "$baseAdminUrl/users",
                'method' => 'get'
            ],
            'all' => [
                'api' => "$baseAdminUrl/users",
                'method' => 'get'
            ],
            'get' => [
                'api' => "$baseAdminUrl/users/{id}",
                'method' => 'get'
            ],
            'update' => [
                'api' => "$baseAdminUrl/users/{id}",
                'method' => 'put'
            ],
            'delete' => [
                'api' => "$baseAdminUrl/users/{id}",
                'method' => 'delete'
            ],
            'groups' => [
                'api' => "$baseAdminUrl/users/{id}/groups",
                'method' => 'get'
            ],
            'addToGroup' => [
                'api' => "$baseAdminUrl/users/{id}/groups/{groupId}",
                'method' => 'put'
            ],
            'deleteFromGroup' => [
                'api' => "$baseAdminUrl/users/{id}/groups/{groupId}",
                'method' => 'delete'
            ],
            'removeTOTP' => [
                'api' => "$baseAdminUrl/users/{id}/remove-totp",
                'method' => 'put'
            ],
            'setTemporaryPassword' => [
                'api' => "$baseAdminUrl/users/{id}/reset-password",
                'method' => 'put'
            ],
            'verifyByEmail' => [
                'api' => "$baseAdminUrl/users/{id}/send-verify-email",
                'method' => 'put'
            ],
            'roleMappings' => [
                'api' => "$baseAdminUrl/users/{id}/role-mappings",
                'method' => 'get'
            ],
            'addRealmRoles' => [
                'api' => "$baseAdminUrl/users/{id}/role-mappings/realm",
                'method' => 'post'
            ],
            'getRealmRoles' => [
                'api' => "$baseAdminUrl/users/{id}/role-mappings/realm",
                'method' => 'get'
            ],
            'deleteRealmRoles' => [
                'api' => "$baseAdminUrl/users/{id}/role-mappings/realm",
                'method' => 'delete'
            ],
            'getAvailableRealmRoles' => [
                'api' => "$baseAdminUrl/users/{id}/role-mappings/realm/available",
                'method' => 'get'
            ],
            'getEffectiveRealmRoles' => [
                'api' => "$baseAdminUrl/users/{id}/role-mappings/realm/composite",
                'method' => 'get'
            ]
        ],


        'addon' => [
            'logoutById' => [
                'api' => "$baseAdminUrl/users/{id}/logout",
                'method' => 'post'
            ],
            'setAccessTokenExpiry' => [
                'api' => "$baseAdminUrl/",
                'method' => 'post'
            ],
            'testLDAPConnection' => [
                'api' => "$baseAdminUrl/testLDAPConnection",
                'method' => 'post'
            ]
        ],


        'role' => [
            'create' => [
                'api' => "$baseAdminUrl/roles",
                'method' => 'post'
            ],
            'all' => [
                'api' => "$baseAdminUrl/roles",
                'method' => 'get'
            ],
            'get' => [
                'api' => "$baseAdminUrl/roles-by-id/{id}",
                'method' => 'get'
            ],
            'getByName' => [
                'api' => "$baseAdminUrl/roles/{role}",
                'method' => 'get'
            ],
            'update' => [
                'api' => "$baseAdminUrl/roles-by-id/{id}",
                'method' => 'put'
            ],
            'updateByName' => [
                'api' => "$baseAdminUrl/roles/{role}",
                'method' => 'put'
            ],
            'delete' => [
                'api' => "$baseAdminUrl/roles-by-id/{id}",
                'method' => 'delete'
            ],
            'deleteByName' => [
                'api' => "$baseAdminUrl/roles/{role}",
                'method' => 'delete'
            ],
        ]
    ]
];
