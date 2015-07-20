<?php
namespace App\Estar\Eloquent;
class RepoEmployee extends EstarRepo{
    function model(){
        return 'App\Employee';
    }
}