<?php


namespace App\Http\Services;


class UploadService
{
    public function handleUpload($request)
    {
        // Kiểm tra xem có tệp được gửi lên không
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Kiểm tra xem tệp có phải là file ảnh hay không
            if ($this->isImage($file)) {
                // Tạo tên tệp duy nhất
                $fileName = $this->generateUniqueFileName($file);

                // Lưu trữ tệp hình ảnh
                $file->move(public_path('productImg'), $fileName);

                // Lưu tên tệp vào cơ sở dữ liệu
                // yourDatabaseSaveFunction($fileName);

                // Gửi thông báo thành công hoặc thực hiện các thao tác khác
                return "Tệp đã được tải lên và lưu trữ thành công!";
            } else {
                // Nếu tệp không phải là file ảnh
                return "Vui lòng chỉ chọn tệp ảnh để tải lên!";
            }
        } else {
            // Nếu không có tệp được gửi lên
            return "Vui lòng chọn một tệp để tải lên!";
        }
    }

// Kiểm tra xem tệp có phải là file ảnh hay không
    private function isImage($file)
    {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $extension = strtolower($file->getClientOriginalExtension());
        return in_array($extension, $allowedExtensions);
    }

// Tạo tên tệp duy nhất
    private function generateUniqueFileName($file)
    {
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $uniqueName = $originalName;

        $counter = 1;
        while (file_exists(public_path('images/' . $uniqueName))) {
            $uniqueName = $counter . '_' . $originalName;
            $counter++;
        }

        $uniqueFileName = time() . '_' . $uniqueName;
        return $uniqueFileName;
    }

}
