<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhachHangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('customers')->delete();

        DB::table('customers')->truncate();

        DB::table('customers')->insert([
            [
                'email'             => 'test@gmail.com',
                'so_dien_thoai'     => '0905523543',
                'ho'                => 'Admin',
                'dem'               => '',
                'ten'               => 'Test',
                'ngay_sinh'         => '1999-08-07',
                'status'            => 1,
                'dia_chi'           => 'aaaaaaaaaaaaaaaaaaaaa',
                'password'          => bcrypt('123123'),
            ],
            [
                'email'             => 'thanhnhan@gmail.com',
                'so_dien_thoai'     => '0889470271',
                'ho'                => 'Bùi',
                'dem'               => 'Đỗ Thanh',
                'ten'               => 'Nhân',
                'ngay_sinh'         => '2001-11-15',
                'status'            => 1,
                'dia_chi'           => 'aaaaaaaaaaaaaaaaaaaaa',
                'password'          => bcrypt('123123'),
            ],
            [
                'email'             => 'quocbao@gmail.com',
                'so_dien_thoai'     => '0369368075',
                'ho'                => 'Trần',
                'dem'               => 'Văn Quốc',
                'ten'               => 'Bảo',
                'ngay_sinh'         => '2003-03-13',
                'status'            => 1,
                'dia_chi'           => 'aaaaaaaaaaaaaaaaaaaaa',
                'password'          => bcrypt('123123'),
            ],
            [
                'email'             => 'thang@gmail.com',
                'so_dien_thoai'     => '0905074885',
                'ho'                => 'Nguyễn',
                'dem'               => 'Đức',
                'ten'               => 'Thắng',
                'ngay_sinh'         => '2001-07-08',
                'status'            => 1,
                'dia_chi'           => 'aaaaaaaaaaaaaaaaaaaaa',
                'password'          => bcrypt('123123'),
            ],
            [
                'email'             => 'thien@gmail.com',
                'so_dien_thoai'     => '0376659652',
                'ho'                => 'Trần',
                'dem'               => 'Nhật',
                'ten'               => 'Thiên',
                'ngay_sinh'         => '1999-11-23',
                'status'            => 1,
                'dia_chi'           => 'aaaaaaaaaaaaaaaaaaaaa',
                'password'          => bcrypt('123123'),
            ],
            [
                'email'             => 'lch131002@gmail.com',
                'so_dien_thoai'     => '0905081330',
                'ho'                => 'Lê',
                'dem'               => 'Công',
                'ten'               => 'Hậu',
                'ngay_sinh'         => '2003-07-16',
                'status'            => 1,
                'dia_chi'           => 'aaaaaaaaaaaaaaaaaaaaa',
                'password'          => bcrypt('123456'),
            ],
        ]);
    }
}
