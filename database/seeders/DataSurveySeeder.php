<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Relawan;
use App\Models\DataSurvey;
use App\Models\KelurahanDesa;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataSurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $data_surveys = array(
            array(
                "id" => 1,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIWAWO",
                "kelurahan_desa" => "GATTARENG",
                "jumlah_kk" => "643",
                "estimasi" => "322",
                "relawan" => "10",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 2,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIWAWO",
                "kelurahan_desa" => "MARIO RIAJA",
                "jumlah_kk" => "1110",
                "estimasi" => "555",
                "relawan" => "18",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 3,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIWAWO",
                "kelurahan_desa" => "WATU",
                "jumlah_kk" => "884",
                "estimasi" => "442",
                "relawan" => "14",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 4,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIWAWO",
                "kelurahan_desa" => "MARIO RITTENGNGA",
                "jumlah_kk" => "919",
                "estimasi" => "460",
                "relawan" => "15",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 5,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIWAWO",
                "kelurahan_desa" => "GOARIE",
                "jumlah_kk" => "1220",
                "estimasi" => "610",
                "relawan" => "20",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 6,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIWAWO",
                "kelurahan_desa" => "BARAE",
                "jumlah_kk" => "755",
                "estimasi" => "378",
                "relawan" => "12",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 7,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIWAWO",
                "kelurahan_desa" => "MARIO RILAU",
                "jumlah_kk" => "1008",
                "estimasi" => "504",
                "relawan" => "16",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 8,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIWAWO",
                "kelurahan_desa" => "TETTIKENGRARAE",
                "jumlah_kk" => "1948",
                "estimasi" => "974",
                "relawan" => "32",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 9,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIWAWO",
                "kelurahan_desa" => "LABESSI",
                "jumlah_kk" => "841",
                "estimasi" => "421",
                "relawan" => "14",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 10,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIWAWO",
                "kelurahan_desa" => "CONGKO",
                "jumlah_kk" => "631",
                "estimasi" => "316",
                "relawan" => "10",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 11,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIWAWO",
                "kelurahan_desa" => "WATUTOA",
                "jumlah_kk" => "961",
                "estimasi" => "481",
                "relawan" => "16",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 12,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIWAWO",
                "kelurahan_desa" => "GATTARENG TOA",
                "jumlah_kk" => "660",
                "estimasi" => "330",
                "relawan" => "10",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 13,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIWAWO",
                "kelurahan_desa" => "SOGA",
                "jumlah_kk" => "542",
                "estimasi" => "271",
                "relawan" => "9",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 14,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LALABATA",
                "kelurahan_desa" => "UMPUNGENG",
                "jumlah_kk" => "934",
                "estimasi" => "467",
                "relawan" => "15",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 15,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LALABATA",
                "kelurahan_desa" => "LALABATA RILAU",
                "jumlah_kk" => "2075",
                "estimasi" => "1038",
                "relawan" => "34",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 16,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LALABATA",
                "kelurahan_desa" => "BOTTO",
                "jumlah_kk" => "1226",
                "estimasi" => "613",
                "relawan" => "20",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 17,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LALABATA",
                "kelurahan_desa" => "LEMBA",
                "jumlah_kk" => "1024",
                "estimasi" => "512",
                "relawan" => "17",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 18,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LALABATA",
                "kelurahan_desa" => "BILA",
                "jumlah_kk" => "1921",
                "estimasi" => "961",
                "relawan" => "32",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 19,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LALABATA",
                "kelurahan_desa" => "MATTABULU",
                "jumlah_kk" => "410",
                "estimasi" => "205",
                "relawan" => "6",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 20,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LALABATA",
                "kelurahan_desa" => "OMPO",
                "jumlah_kk" => "740",
                "estimasi" => "370",
                "relawan" => "12",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 21,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LALABATA",
                "kelurahan_desa" => "LAPAJUNG",
                "jumlah_kk" => "1452",
                "estimasi" => "726",
                "relawan" => "24",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 22,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LALABATA",
                "kelurahan_desa" => "MACCILE",
                "jumlah_kk" => "932",
                "estimasi" => "466",
                "relawan" => "15",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 23,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LALABATA",
                "kelurahan_desa" => "SALO KARAJA",
                "jumlah_kk" => "795",
                "estimasi" => "398",
                "relawan" => "12",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 24,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LILI RIAJA",
                "kelurahan_desa" => "TIMUSU",
                "jumlah_kk" => "1100",
                "estimasi" => "550",
                "relawan" => "18",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 25,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LILI RIAJA",
                "kelurahan_desa" => "ROMPEGADING",
                "jumlah_kk" => "631",
                "estimasi" => "316",
                "relawan" => "10",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 26,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LILI RIAJA",
                "kelurahan_desa" => "PATTOJO",
                "jumlah_kk" => "690",
                "estimasi" => "345",
                "relawan" => "11",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 27,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LILI RIAJA",
                "kelurahan_desa" => "GALUNG",
                "jumlah_kk" => "695",
                "estimasi" => "348",
                "relawan" => "11",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 28,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LILI RIAJA",
                "kelurahan_desa" => "JENNAE",
                "jumlah_kk" => "2192",
                "estimasi" => "1096",
                "relawan" => "35",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 29,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LILI RIAJA",
                "kelurahan_desa" => "JAMPU",
                "jumlah_kk" => "734",
                "estimasi" => "367",
                "relawan" => "12",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 30,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LILI RIAJA",
                "kelurahan_desa" => "BARANG",
                "jumlah_kk" => "678",
                "estimasi" => "339",
                "relawan" => "11",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 31,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LILI RIAJA",
                "kelurahan_desa" => "APPANANG",
                "jumlah_kk" => "1140",
                "estimasi" => "570",
                "relawan" => "19",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 32,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "GANRA",
                "kelurahan_desa" => "BELO",
                "jumlah_kk" => "752",
                "estimasi" => "376",
                "relawan" => "12",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 33,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "GANRA",
                "kelurahan_desa" => "GANRA",
                "jumlah_kk" => "925",
                "estimasi" => "463",
                "relawan" => "15",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 34,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "GANRA",
                "kelurahan_desa" => "ENREKENG",
                "jumlah_kk" => "505",
                "estimasi" => "253",
                "relawan" => "8",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 35,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "GANRA",
                "kelurahan_desa" => "LOMPULLE",
                "jumlah_kk" => "888",
                "estimasi" => "444",
                "relawan" => "14",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 36,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "CITTA",
                "kelurahan_desa" => "KAMPIRI",
                "jumlah_kk" => "483",
                "estimasi" => "242",
                "relawan" => "8",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 37,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "CITTA",
                "kelurahan_desa" => "CITTA",
                "jumlah_kk" => "875",
                "estimasi" => "438",
                "relawan" => "14",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 38,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "CITTA",
                "kelurahan_desa" => "LABAE",
                "jumlah_kk" => "515",
                "estimasi" => "258",
                "relawan" => "8",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 39,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "CITTA",
                "kelurahan_desa" => "TINCO",
                "jumlah_kk" => "348",
                "estimasi" => "174",
                "relawan" => "5",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 40,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LILI RILAU",
                "kelurahan_desa" => "PAJALESANG",
                "jumlah_kk" => "1299",
                "estimasi" => "650",
                "relawan" => "20",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 41,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LILI RILAU",
                "kelurahan_desa" => "CABENGE",
                "jumlah_kk" => "1234",
                "estimasi" => "617",
                "relawan" => "20",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 42,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LILI RILAU",
                "kelurahan_desa" => "PAROTO",
                "jumlah_kk" => "677",
                "estimasi" => "339",
                "relawan" => "11",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 43,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LILI RILAU",
                "kelurahan_desa" => "PALANGISENG",
                "jumlah_kk" => "681",
                "estimasi" => "341",
                "relawan" => "11",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 44,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LILI RILAU",
                "kelurahan_desa" => "TETEWATU",
                "jumlah_kk" => "403",
                "estimasi" => "202",
                "relawan" => "6",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 45,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LILI RILAU",
                "kelurahan_desa" => "ABBANUANGE",
                "jumlah_kk" => "910",
                "estimasi" => "455",
                "relawan" => "15",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 47,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LILI RILAU",
                "kelurahan_desa" => "UJUNG",
                "jumlah_kk" => "972",
                "estimasi" => "486",
                "relawan" => "16",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 48,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LILI RILAU",
                "kelurahan_desa" => "MASING",
                "jumlah_kk" => "716",
                "estimasi" => "358",
                "relawan" => "11",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 49,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LILI RILAU",
                "kelurahan_desa" => "BARINGENG",
                "jumlah_kk" => "1535",
                "estimasi" => "768",
                "relawan" => "25",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 50,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LILI RILAU",
                "kelurahan_desa" => "KEBO",
                "jumlah_kk" => "815",
                "estimasi" => "408",
                "relawan" => "12",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 51,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "LILI RILAU",
                "kelurahan_desa" => "MACANRE",
                "jumlah_kk" => "757",
                "estimasi" => "379",
                "relawan" => "12",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 52,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "DONRI DONRI",
                "kelurahan_desa" => "PESSE",
                "jumlah_kk" => "676",
                "estimasi" => "338",
                "relawan" => "11",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 53,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "DONRI DONRI",
                "kelurahan_desa" => "PISING",
                "jumlah_kk" => "673",
                "estimasi" => "337",
                "relawan" => "11",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 54,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "DONRI DONRI",
                "kelurahan_desa" => "LABOKONG",
                "jumlah_kk" => "870",
                "estimasi" => "435",
                "relawan" => "14",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 55,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "DONRI DONRI",
                "kelurahan_desa" => "DONRI-DONRI",
                "jumlah_kk" => "711",
                "estimasi" => "356",
                "relawan" => "11",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 56,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "DONRI DONRI",
                "kelurahan_desa" => "SERING",
                "jumlah_kk" => "597",
                "estimasi" => "299",
                "relawan" => "9",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 57,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "DONRI DONRI",
                "kelurahan_desa" => "LALABATA RIAJA",
                "jumlah_kk" => "1012",
                "estimasi" => "506",
                "relawan" => "16",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 58,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "DONRI DONRI",
                "kelurahan_desa" => "TOTTONG",
                "jumlah_kk" => "805",
                "estimasi" => "403",
                "relawan" => "12",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 59,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "DONRI DONRI",
                "kelurahan_desa" => "LEWORENG",
                "jumlah_kk" => "843",
                "estimasi" => "422",
                "relawan" => "14",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 60,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "DONRI DONRI",
                "kelurahan_desa" => "KESSING",
                "jumlah_kk" => "612",
                "estimasi" => "306",
                "relawan" => "10",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 61,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIAWA",
                "kelurahan_desa" => "PATAMPANUA",
                "jumlah_kk" => "650",
                "estimasi" => "325",
                "relawan" => "10",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 62,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIAWA",
                "kelurahan_desa" => "PANINCONG",
                "jumlah_kk" => "1200",
                "estimasi" => "600",
                "relawan" => "20",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 63,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIAWA",
                "kelurahan_desa" => "TELLULIMPOE",
                "jumlah_kk" => "839",
                "estimasi" => "420",
                "relawan" => "12",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 64,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIAWA",
                "kelurahan_desa" => "ATTANG SALO",
                "jumlah_kk" => "744",
                "estimasi" => "372",
                "relawan" => "12",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 65,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIAWA",
                "kelurahan_desa" => "KACA",
                "jumlah_kk" => "587",
                "estimasi" => "294",
                "relawan" => "9",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 66,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIAWA",
                "kelurahan_desa" => "LIMPOMAJANG",
                "jumlah_kk" => "588",
                "estimasi" => "294",
                "relawan" => "9",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 67,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIAWA",
                "kelurahan_desa" => "BATU-BATU",
                "jumlah_kk" => "646",
                "estimasi" => "323",
                "relawan" => "10",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 68,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIAWA",
                "kelurahan_desa" => "MANORANG SALO",
                "jumlah_kk" => "1217",
                "estimasi" => "609",
                "relawan" => "20",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 69,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIAWA",
                "kelurahan_desa" => "LARINGGI",
                "jumlah_kk" => "862",
                "estimasi" => "431",
                "relawan" => "14",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 70,
                "kabupaten" => "KABUPATEN SOPPENG",
                "kecamatan" => "MARIO RIAWA",
                "kelurahan_desa" => "BULUE",
                "jumlah_kk" => "882",
                "estimasi" => "441",
                "relawan" => "14",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
        );

        DataSurvey::insert($data_surveys);
        $KEL = Role::create(['name' => 'KEL']);
        $KEL->givePermissionTo('KEL list');
        $KEL->givePermissionTo('KEL create');
        $KEL->givePermissionTo('KEL edit');
        $KEL->givePermissionTo('KEL delete');
        for ($i = 0; $i < count($data_surveys); $i++) {
            for ($k = 0; $k < $data_surveys[$i]['relawan']; $k++) {
                $kel_user = User::create(array(
                    "name" => "kel_" . $data_surveys[$i]['kelurahan_desa'],
                    "username" => "user" . fake()->unique()->randomNumber(),
                    "email" => "kelurahan" .fake()->unique()->randomNumber() . "@gmail.com",
                    "email_verified_at" => NULL,
                    "password" => bcrypt('12345678'),
                    "lokasi" => $data_surveys[$i]['kelurahan_desa'],
                    "jabatan" => "Relawan",
                    "datasurvey_id" => $data_surveys[$i]['id'],
                    "remember_token" => NULL,
                    "created_at" => "2023-03-07 21:57:00",
                    "updated_at" => "2023-03-07 21:57:00",
                ));
                $kel_user->assignRole($KEL);
                Relawan::create([
                    'nama' => fake()->name(),
                    'no_hp' => fake()->phoneNumber(),
                    'alamat' => fake()->address(),
                    'user_id' => $kel_user->id,
                ]);
            }
        }
    }
}
