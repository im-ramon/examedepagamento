<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PgConstante;

class PgConstanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PgConstante::create(['pg' => 'GEN EX_NA INATIVIDAD ', 'pg_abrev' => 'Gen Ex Inat', 'adic_mil' => 28, 'soldo' => 14031]);
        PgConstante::create(['pg' => 'GENERAL DE EXERCITO', 'pg_abrev' => 'Gen Ex', 'adic_mil' => 28, 'soldo' => 13471]);
        PgConstante::create(['pg' => 'GENERAL DE DIVISAO', 'pg_abrev' => 'Gen Div', 'adic_mil' => 28, 'soldo' => 12912]);
        PgConstante::create(['pg' => 'GENERAL DE BRIGADA', 'pg_abrev' => 'Gen Bda', 'adic_mil' => 28, 'soldo' => 12490]);
        PgConstante::create(['pg' => 'CORONEL', 'pg_abrev' => 'Cel', 'adic_mil' => 25, 'soldo' => 11451]);
        PgConstante::create(['pg' => 'TENENTE-CORONEL', 'pg_abrev' => 'TC', 'adic_mil' => 25, 'soldo' => 11250]);
        PgConstante::create(['pg' => 'MAJOR', 'pg_abrev' => 'Maj', 'adic_mil' => 25, 'soldo' => 11088]);
        PgConstante::create(['pg' => 'CAPITÃO', 'pg_abrev' => 'Cap', 'adic_mil' => 22, 'soldo' => 9135]);
        PgConstante::create(['pg' => 'PRIMEIRO-TENENTE', 'pg_abrev' => '1º Ten', 'adic_mil' => 19, 'soldo' => 8245]);
        PgConstante::create(['pg' => 'SEGUNDO-TENENTE', 'pg_abrev' => '2º Ten', 'adic_mil' => 19, 'soldo' => 7490]);
        PgConstante::create(['pg' => 'ASPIRANTE-A-OFICIAL', 'pg_abrev' => 'Asp Of', 'adic_mil' => 19, 'soldo' => 7315]);
        PgConstante::create(['pg' => 'CADETE ULTIMO ANO', 'pg_abrev' => 'Cad último ano', 'adic_mil' => 0, 'soldo' => 1630]);
        PgConstante::create(['pg' => 'CADETE 1/2/3 ANO', 'pg_abrev' => 'Cad 1/2/3 ano', 'adic_mil' => 0, 'soldo' => 1334]);
        PgConstante::create(['pg' => 'ALUNO CPOR/NPOR/IME', 'pg_abrev' => 'Al CPOR', 'adic_mil' => 0, 'soldo' => 1334]);
        PgConstante::create(['pg' => 'ALUNO ES F S', 'pg_abrev' => 'Al ES F S', 'adic_mil' => 0, 'soldo' => 1199]);
        PgConstante::create(['pg' => 'ALUNO EPC', 'pg_abrev' => 'Al EPC', 'adic_mil' => 0, 'soldo' => 1199]);
        PgConstante::create(['pg' => 'ALUNO EPC 1/2/3', 'pg_abrev' => 'Al EPC 1/2/3', 'adic_mil' => 0, 'soldo' => 1185]);
        PgConstante::create(['pg' => 'SUB-TENENTE', 'pg_abrev' => 'S Ten', 'adic_mil' => 16, 'soldo' => 6169]);
        PgConstante::create(['pg' => 'PRIMEIRO-SARGENTO', 'pg_abrev' => '1º Sgt', 'adic_mil' => 16, 'soldo' => 5483]);
        PgConstante::create(['pg' => 'SEGUNDO-SARGENTO', 'pg_abrev' => '2º Sgt', 'adic_mil' => 16, 'soldo' => 4770]);
        PgConstante::create(['pg' => 'TERCEIRO-SARGENTO', 'pg_abrev' => '3º Sgt', 'adic_mil' => 16, 'soldo' => 3825]);
        PgConstante::create(['pg' => 'CABO ENGAJADO', 'pg_abrev' => 'Cb Eng', 'adic_mil' => 13, 'soldo' => 2627]);
        PgConstante::create(['pg' => 'CABO NAO ENGAJADO', 'pg_abrev' => 'Cb N Eng', 'adic_mil' => 0, 'soldo' => 1078]);
        PgConstante::create(['pg' => 'SOLDADO PQDT (ENG)', 'pg_abrev' => 'Sd Esp', 'adic_mil' => 13, 'soldo' => 1926]);
        PgConstante::create(['pg' => 'SD 2A CL (CLAR/CORN)', 'pg_abrev' => 'Sd 2A Cl', 'adic_mil' => 13, 'soldo' => 1765]);
        PgConstante::create(['pg' => 'SD 3A CL (CLAR/CORN)', 'pg_abrev' => 'Sd 3A Cl', 'adic_mil' => 0, 'soldo' => 1078]);
        PgConstante::create(['pg' => 'SOLDADO DO EXERCITO', 'pg_abrev' => 'Sd Eng', 'adic_mil' => 13, 'soldo' => 1765]);
        PgConstante::create(['pg' => 'SOLDADO RECRUTA', 'pg_abrev' => 'Sd Rcr', 'adic_mil' => 0, 'soldo' => 1078]);
        PgConstante::create(['pg' => 'TAIFEIRO-MOR', 'pg_abrev' => 'TF Mor', 'adic_mil' => 13, 'soldo' => 2627]);
        PgConstante::create(['pg' => 'TAIFEIRO 1 CL', 'pg_abrev' => 'TF 1Cl', 'adic_mil' => 13, 'soldo' => 2325]);
        PgConstante::create(['pg' => 'TAIFEIRO 2 CL', 'pg_abrev' => 'TF 2Cl', 'adic_mil' => 13, 'soldo' => 2210]);
    }
}
