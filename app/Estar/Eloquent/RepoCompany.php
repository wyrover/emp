<?php
namespace App\Estar\Eloquent;
class RepoCompany extends EstarRepo{
    function model(){
        return 'App\Company';
    }
}