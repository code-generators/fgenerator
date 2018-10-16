
Route::group(['prefix' => 'uadmin', "namespace" => "{{ucfirst($group)}}", "middleware" => "uadmin.auth"], function(){

    Route::get("/{{lcfirst($model)}}/lists", "{{ucfirst($module)}}Controller#{{lcfirst($model)}}Lists")->name("{{lcfirst($group)}}.{{lcfirst($module)}}.{{lcfirst($model)}}.lists");
    Route::any("/{{lcfirst($model)}}/add", "{{ucfirst($module)}}Controller#add{{ucfirst($model)}}")->name("{{lcfirst($group)}}.{{lcfirst($module)}}.{{lcfirst($model)}}.add");
    Route::get("/{{lcfirst($model)}}/view/{id}", "{{ucfirst($module)}}Controller#view{{ucfirst($model)}}")->name("{{lcfirst($group)}}.{{lcfirst($module)}}.{{lcfirst($model)}}.view");
    Route::any("/{{lcfirst($model)}}/edit", "{{ucfirst($module)}}Controller#edit{{ucfirst($model)}}")->name("{{lcfirst($group)}}.{{lcfirst($module)}}.{{lcfirst($model)}}.edit");
    Route::any("/{{lcfirst($model)}}/delete", "{{ucfirst($module)}}Controller#delete{{ucfirst($model)}}")->name("{{lcfirst($group)}}.{{lcfirst($module)}}.{{lcfirst($model)}}.delete");

});

