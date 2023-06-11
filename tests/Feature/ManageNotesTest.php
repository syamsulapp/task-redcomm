<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageNotesTest extends TestCase
{
    /**
     * A basic feature test list.
     */

    public function test_example_list(): void
    {
        $this->json('GET', 'api/v1/notes', ['Accept' => 'application/json'])
            ->assertStatus(200);
    }
    /**
     * A basic feature test filter (search). search by title dan description
     */
    public function test_example_by_search(): void
    {
        $search = [
            'title' => 'catatan merah',
            'desc' => 'catatan merah'
        ];
        $this->json('GET', 'api/v1/notes', $search, ['Accept' => 'application/json'])
            ->assertStatus(200);
    }
    /**
     * A basic feature test pagination.
     */
    public function test_example_by_pagination(): void
    {
        $pagination = [
            'limit' => 2,
            'page' => 1,
        ];
        $this->json('GET', 'api/v1/notes', $pagination, ['Accept' => 'application/json'])
            ->assertStatus(200);
    }
    /**
     * A basic feature test insert data notes into table db.
     * kalo datanya sudah di tambah maka bakal kena validasi unique artinya tidak boleh
     * memasukan data yang sama dan field/params yang di unique kan ialah titles
     */
    public function test_example_store_note(): void
    {
        $data = [
            'title' => 'catatan wadaw',
            'desc' => 'catatan wadaw makin wadaw',
            'text' => '<p> catatan wadaw akan selalu wadaw </p>'
        ];
        $this->json('POST', 'api/v1/notes', $data, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                    'title',
                    'text',
                    'created_at',
                    'updated_at'

                ]
            ]);
    }
    /**
     * memvalidasi request yang dimasukan
     */
    public function test_example_validate_store(): void
    {
        $this->json('POST', 'api/v1/notes', ['Accept' => 'application/json'])
            ->assertStatus(422);
    }
    /**
     * A basic feature test update notes.
     * validate id jika id tidak dimasukan
     */
    public function test_example_validate_id_update_note(): void
    {
        //:id di kosongkan maka response nya 422 yang artinya harus memasukan params/object + id nya
        $this->json('PUT', 'api/v1/notes/:id', ['Accept' => 'application/json'])
            ->assertStatus(422);
    }

    /**
     * A basic feature test update notes.
     * update menggunakan id jika id nya salah maka error jadi pastikan id nya benar
     */
    public function test_example_update_note(): void
    {
        $update = [
            'title' => 'catatan apaan tuh',
            'desc' => 'catatan apaan tuh',
            'text' => '<p> catatan apaan tuh </p>'
        ];
        $this->json('PUT', 'api/v1/notes/8', $update, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                    'title',
                    'text',
                    'created_at',
                    'updated_at'

                ]
            ]);
    }

    /**
     * A basic feature test update notes.
     * validate id jika id tidak dimasukan
     */
    public function test_example_validate_id_delete_note(): void
    {
        //:id di kosongkan maka response nya 422 yang artinya harus memasukan params/object + id nya
        $this->json('delete', 'api/v1/notes/:id', ['Accept' => 'application/json'])
            ->assertStatus(422);
    }

    /**
     * A basic feature test delete notes.
     * delete menggunakan id jika id nya salah maka error jadi pastikan id nya benar
     */
    public function test_example_delete_note(): void
    {
        //:id di kosongkan maka response nya 422 yang artinya harus memasukan params/object + id nya
        $this->json('delete', 'api/v1/notes/3', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                    'title',
                    'text',
                    'created_at',
                    'updated_at'

                ]
            ]);
    }
}
