<?php

namespace SaulGajda\TrivialStorage;

class TrivialStorage {
    public function __construct($filename)
    {
        $this->filename = $filename;
        if ( file_exists($this->filename) ) {
            $this->load();
            return;
        }
        $this->save();
    }

    public function create($key, $item) {
        $this->data[$key] = $item;
        $this->save();
    } 

    public function read($key) {
        if ( !array_key_exists($key, $this->data ) ) {
            return NULL;
        }

        return $this->data[$key];
    }

    public function readAll() {
        return $this->data;
    }

    public function update($key, $item) {
        $this->data[$key] = $item;
        $this->save();
    }

    public function delete($key) {
        if ( !array_key_exists($key, $this->data ) ) {
            return;
        }

        unset( $this->data[$key] );
        $this->save();
    }

    public function deleteAll() {
        $this->data = [];
        $this->save();
    }

    protected $filename = 'data.json';
    protected $data = [];

    protected function load() {
        $this->data = json_decode(file_get_contents($this->filename), true);
    }

    protected function save() {
        file_put_contents($this->filename, json_encode($this->data));
    }
}