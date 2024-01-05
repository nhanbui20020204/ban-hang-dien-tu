<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('partners')->delete();

        DB::table('partners')->truncate();

        DB::table('partners')->insert([

            [
                'ho_lot'            =>  'Thanh',
                'ten'               =>  'Nhân',
                'ngay_sinh'         =>  '2005-08-07',
                'so_dien_thoai'     =>  '0905' . random_int(100000, 999999),
                'dia_chi'           =>  'Đà Nẵng, Việt Nam',
                'ma_so_thue'        =>  '',
                'ten_cong_ty'       =>  '',
                'email'             =>  'nhanbui@gmail.com',
                'password'          =>  bcrypt(123456),
                'tinh_trang'        =>  1,
            ],
            [
                'ho_lot'            =>  'Quốc',
                'ten'               =>  'Bảo',
                'ngay_sinh'         =>  '2006-08-07',
                'so_dien_thoai'     =>  '0905' . random_int(100000, 999999),
                'dia_chi'           =>  'Quảng Nam, Việt Nam',
                'ma_so_thue'        =>  '',
                'ten_cong_ty'       =>  '',
                'email'             =>  'tvqbao@gmail.com',
                'password'          =>  bcrypt(123456),
                'tinh_trang'        =>  0,
            ],
            [
                'ho_lot'            =>  'Nguyễn Đức',
                'ten'               =>  'Thắng',
                'ngay_sinh'         =>  '2006-08-07',
                'so_dien_thoai'     =>  '0905' . random_int(100000, 999999),
                'dia_chi'           =>  'Quảng Nam, Việt Nam',
                'ma_so_thue'        =>  '',
                'ten_cong_ty'       =>  '',
                'email'             =>  'nguyenducthang@gmail.com',
                'password'          =>  bcrypt(123456),
                'tinh_trang'        =>  0,
            ],
            // [
            //     'ho_lot'            =>  'Phùng Văn',
            //     'ten'               =>  'Mạnh',
            //     'ngay_sinh'         =>  '2007-08-07',
            //     'so_dien_thoai'     =>  '0905' . random_int(100000, 999999),
            //     'dia_chi'           =>  'Quảng Trị, Việt Nam',
            //     'ma_so_thue'        =>  '',
            //     'ten_cong_ty'       =>  '',
            //     'email'             =>  'ongmanh@gmail.com',
            //     'password'          =>  bcrypt(123456),
            //     'tinh_trang'        =>  0,
            // ],
            // [
            //     'ho_lot'            =>  'Phan Minh',
            //     'ten'               =>  'Tiến',
            //     'ngay_sinh'         =>  '1999-08-07',
            //     'so_dien_thoai'     =>  '0905' . random_int(100000, 999999),
            //     'dia_chi'           =>  'Quảng Ninh, Việt Nam',
            //     'ma_so_thue'        =>  '',
            //     'ten_cong_ty'       =>  '',
            //     'email'             =>  'muvodich@gmail.com',
            //     'password'          =>  bcrypt(123456),
            //     'tinh_trang'        =>  1,
            // ],
            // [
            //     'ho_lot'            =>  'Trần Nguyễn Duy',
            //     'ten'               =>  'Khánh',
            //     'ngay_sinh'         =>  '2001-08-07',
            //     'so_dien_thoai'     =>  '0905' . random_int(100000, 999999),
            //     'dia_chi'           =>  'Hà Nội, Việt Nam',
            //     'ma_so_thue'        =>  '',
            //     'ten_cong_ty'       =>  '',
            //     'email'             =>  'skycuatoi@gmail.com',
            //     'password'          =>  bcrypt(123456),
            //     'tinh_trang'        =>  2,
            // ],
            // [
            //     'ho_lot'            =>  'Trương Công',
            //     'ten'               =>  'Thạch',
            //     'ngay_sinh'         =>  '2002-08-07',
            //     'so_dien_thoai'     =>  '0905' . random_int(100000, 999999),
            //     'dia_chi'           =>  'Huế City, Việt Nam',
            //     'ma_so_thue'        =>  '',
            //     'ten_cong_ty'       =>  '',
            //     'email'             =>  'mystone@gmail.com',
            //     'password'          =>  bcrypt(123456),
            //     'tinh_trang'        =>  1,
            // ],
            // [
            //     'ho_lot'            =>  'Nguyễn Vũ',
            //     'ten'               =>  'Huy',
            //     'ngay_sinh'         =>  '2002-08-07',
            //     'so_dien_thoai'     =>  '0905' . random_int(100000, 999999),
            //     'dia_chi'           =>  'Cần Thơ City, Việt Nam',
            //     'ma_so_thue'        =>  '',
            //     'ten_cong_ty'       =>  '',
            //     'email'             =>  'emtraingokhong@gmail.com',
            //     'password'          =>  bcrypt(123456),
            //     'tinh_trang'        =>  2,
            // ],
        ]);
    }
}
