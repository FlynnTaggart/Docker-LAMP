<?php
interface DatabaseInt {
    public function query($query = "" , $params = []);
}