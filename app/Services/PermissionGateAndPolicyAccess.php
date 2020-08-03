<?php
namespace App\Services;

use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicyAccess
{
    public function setGateAndPolicyAccess()
    {
        $this->defineGateCategory();
        $this->defineGateProduct();
        $this->defineGateUser();
    }
    public function defineGateCategory()
    {
        Gate::define('category-list','App\Policies\CategoryPolicy@view');
        Gate::define('category-create','App\Policies\CategoryPolicy@create');
        Gate::define('category-edit','App\Policies\CategoryPolicy@update');
        Gate::define('category-delete','App\Policies\CategoryPolicy@delete');
    }
    public function defineGateProduct()
    {
        Gate::define('product-list','App\Policies\ProductPolicy@view');
        Gate::define('product-create','App\Policies\ProductPolicy@create');
        Gate::define('product-edit','App\Policies\ProductPolicy@update');
        Gate::define('product-delete','App\Policies\ProductPolicy@delete');
    }
    public function defineGateUser()
    {
        Gate::define('user-list','App\Policies\UserPolicy@view');
    }
}
