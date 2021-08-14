<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'humanResource' => [
        'title'          => 'Kontak',
        'title_singular' => 'Kontak',
    ],
    'sister' => [
        'title'          => 'Suster dan Pembantu',
        'title_singular' => 'Suster dan Pembantu',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'name'                   => 'Nama Lengkap',
            'name_helper'            => ' ',
            'province'               => 'Provinsi',
            'province_helper'        => ' ',
            'city'                   => 'Kota/Kabupaten',
            'city_helper'            => ' ',
            'sub_district'           => 'Kecamatan',
            'sub_district_helper'    => ' ',
            'ward'                   => 'Kelurahan',
            'ward_helper'            => ' ',
            'address'                => 'Address',
            'address_helper'         => ' ',
            'self_image'             => 'Foto',
            'self_image_helper'      => ' ',
            'ktp_image'              => 'Foto KTP',
            'ktp_image_helper'       => ' ',
            'status'                 => 'Status',
            'status_helper'          => ' ',
            'prefered_salary'        => 'Permintaan Gaji',
            'prefered_salary_helper' => ' ',
            'type'                   => 'Tipe',
            'type_helper'            => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'number'                 => 'Nomor Telepon',
            'number_helper'          => ' ',
            'age'                    => 'Usia',
            'age_helper'             => ' ',
        ],
    ],
    'klien' => [
        'title'          => 'Klien',
        'title_singular' => 'Klien',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'name'                => 'Nama Lengkap',
            'name_helper'         => ' ',
            'province'            => 'Provinsi',
            'province_helper'     => ' ',
            'city'                => 'Kota/Kabupaten',
            'city_helper'         => ' ',
            'sub_district'        => 'Kecamatan',
            'sub_district_helper' => ' ',
            'ward'                => 'Kelurahan',
            'ward_helper'         => ' ',
            'address'             => 'Address',
            'address_helper'      => ' ',
            'self_image'          => 'Foto',
            'self_image_helper'   => ' ',
            'status'              => 'Status',
            'status_helper'       => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'number'              => 'Nomor Telepon',
            'number_helper'       => ' ',
        ],
    ],
    'contract' => [
        'title'          => 'Contract',
        'title_singular' => 'Contract',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'sister'            => 'Sister',
            'sister_helper'     => ' ',
            'client'            => 'Client',
            'client_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
];