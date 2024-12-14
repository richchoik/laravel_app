<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Concerns\ValidatesAttributes;

trait Test
{
    use ValidatesAttributes;

    public function tester($a, $b)
    {
        return $this->shouldBlockPhpUpload($a, $b);
    }
}

class Validate
{
    use Test;
}

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUpload()
    {
        return view('Upload');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $validate = new Validate;

        if (!$validate->tester($request->image, ['sfdfsdfdsfs'])) {
            $re = 'okok';
        } else {
            $re = 'no ok';
            return back()->with('fail', 'Fail');
        }

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);

        /* Store $imageName name in DATABASE from HERE */

        return back()
            ->with('success', 'You have successfully uploaded the image.' . $re)
            ->with('image', $imageName);
    }
}
