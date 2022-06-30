<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingRequest;
use App\Http\Resources\Admin\Setting\SettingResource;
use App\Models\Setting;
use App\Traits\ApiResponser;

class SettingController extends Controller
{
    use ApiResponser;

    public function show()
    {
        $setting = Setting::where('user_id', auth()->user()->id)->firstOrFail();
        return $this->respondSuccess(new SettingResource($setting));
    }

    public function update(UpdateSettingRequest $request)
    {
        $settingData = $request->all();
        $setting = Setting::where('user_id', auth()->user()->id)->firstOrFail();
        $setting->update($settingData);
        return $this->respondSuccess(new SettingResource($setting));
    }
}
