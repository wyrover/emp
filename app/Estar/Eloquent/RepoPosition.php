<?php
namespace App\Estar\Eloquent;
class RepoPosition extends EstarRepo{
    function model(){
        return 'App\Position';
    }
}