<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\File;

class PostCreateValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function validationData() {
        $all = parent::validationData();

        if (array_key_exists('image_file', $all)) {
            $all['image_file'] = $this->base64ToFile($all['image_file']);
        }

        return $all;
    }

    /**
     * base64のデータを一時的にファイルに変換し、ファイルの添付情報を返却する関数
     */
    private function base64ToFile(string $base64) {
        if(strlen($base64) < 50) {
            return null;
        }

        $substrBase64 = substr($base64, 0, 50);

        if (! preg_match('/data\:.*\;base64\,/', $substrBase64)) {
            return null;
        }

        $explodeBase64 = explode(',', $base64);
        $replacedBase64 = str_replace(' ', '+', $explodeBase64[1]);

        $content = base64_decode($replacedBase64);

        $tmpFilePath = sys_get_temp_dir() . '/' . Str::uuid()->toString();

        file_put_contents($tmpFilePath, $content);
        $tmpFile = new File($tmpFilePath);

        return new UploadedFile($tmpFile->getPathname(), $tmpFile->getFilename(), $tmpFile->getMimeType(), 0, true);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post' => 'required|max:255',
            'image_file' => 'max:1500'
        ];
    }

    /**
     * エラー時のレスポンスを定義
     */
    protected function failedValidation(Validator $validator) {
        $res = response()->json([
            'status' => 400,
            'errors' => $validator->errors(),
        ], 400);
        throw new HttpResponseException($res);
    }
}
