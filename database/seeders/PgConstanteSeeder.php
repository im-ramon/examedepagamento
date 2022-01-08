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
        PgConstante::create(['pg' => 'Gen Ex Inat', 'pg_abrev' => 'GEN EX_NA INATIVIDADE', 'adic_mil' => 28, 'soldo' => 14031]);
        PgConstante::create(['pg' => 'Gen Ex', 'pg_abrev' => 'GENERAL DE EXERCITO', 'adic_mil' => 28, 'soldo' => 13471]);
        PgConstante::create(['pg' => 'Gen Div', 'pg_abrev' => 'GENERAL DE DIVISAO', 'adic_mil' => 28, 'soldo' => 12912]);
        PgConstante::create(['pg' => 'Gen Bda', 'pg_abrev' => 'GENERAL DE BRIGADA', 'adic_mil' => 28, 'soldo' => 12490]);
        PgConstante::create(['pg' => 'Cel', 'pg_abrev' => 'CORONEL', 'adic_mil' => 25, 'soldo' => 11451]);
        PgConstante::create(['pg' => 'TC', 'pg_abrev' => 'TENENTE-CORONEL', 'adic_mil' => 25, 'soldo' => 11250]);
        PgConstante::create(['pg' => 'Maj', 'pg_abrev' => 'MAJOR', 'adic_mil' => 25, 'soldo' => 11088]);
        PgConstante::create(['pg' => 'Cap', 'pg_abrev' => 'CAPITÃO', 'adic_mil' => 22, 'soldo' => 9135]);
        PgConstante::create(['pg' => '1º Ten', 'pg_abrev' => 'PRIMEIRO-TENENTE', 'adic_mil' => 19, 'soldo' => 8245]);
        PgConstante::create(['pg' => '2º Ten', 'pg_abrev' => 'SEGUNDO-TENENTE', 'adic_mil' => 19, 'soldo' => 7490]);
        PgConstante::create(['pg' => 'Asp Of', 'pg_abrev' => 'ASPIRANTE-A-OFICIAL', 'adic_mil' => 19, 'soldo' => 7315]);
        PgConstante::create(['pg' => 'Cad último ano', 'pg_abrev' => 'CADETE ULTIMO ANO', 'adic_mil' => 0, 'soldo' => 1630]);
        PgConstante::create(['pg' => 'Cad 1/2/3 ano', 'pg_abrev' => 'CADETE 1/2/3 ANO', 'adic_mil' => 0, 'soldo' => 1334]);
        PgConstante::create(['pg' => 'Al CPOR', 'pg_abrev' => 'ALUNO CPOR/NPOR/IME', 'adic_mil' => 0, 'soldo' => 1334]);
        PgConstante::create(['pg' => 'Al ES F S', 'pg_abrev' => 'ALUNO ES F S', 'adic_mil' => 0, 'soldo' => 1199]);
        PgConstante::create(['pg' => 'Al EPC', 'pg_abrev' => 'ALUNO EPC', 'adic_mil' => 0, 'soldo' => 1199]);
        PgConstante::create(['pg' => 'Al EPC 1/2/3', 'pg_abrev' => 'ALUNO EPC 1/2/3', 'adic_mil' => 0, 'soldo' => 1185]);
        PgConstante::create(['pg' => 'S Ten', 'pg_abrev' => 'SUB-TENENTE', 'adic_mil' => 16, 'soldo' => 6169]);
        PgConstante::create(['pg' => '1º Sgt', 'pg_abrev' => 'PRIMEIRO-SARGENTO', 'adic_mil' => 16, 'soldo' => 5483]);
        PgConstante::create(['pg' => '2º Sgt', 'pg_abrev' => 'SEGUNDO-SARGENTO', 'adic_mil' => 16, 'soldo' => 4770]);
        PgConstante::create(['pg' => '3º Sgt', 'pg_abrev' => 'TERCEIRO-SARGENTO', 'adic_mil' => 16, 'soldo' => 3825]);
        PgConstante::create(['pg' => 'Cb Eng', 'pg_abrev' => 'CABO ENGAJADO', 'adic_mil' => 13, 'soldo' => 2627]);
        PgConstante::create(['pg' => 'Cb N Eng', 'pg_abrev' => 'CABO NAO ENGAJADO', 'adic_mil' => 0, 'soldo' => 1078]);
        PgConstante::create(['pg' => 'Sd Esp', 'pg_abrev' => 'SOLDADO PQDT (ENG)', 'adic_mil' => 13, 'soldo' => 1926]);
        PgConstante::create(['pg' => 'Sd 2A Cl', 'pg_abrev' => 'SD 2A CL (CLAR/CORN)', 'adic_mil' => 13, 'soldo' => 1765]);
        PgConstante::create(['pg' => 'Sd 3A Cl', 'pg_abrev' => 'SD 3A CL (CLAR/CORN)', 'adic_mil' => 0, 'soldo' => 1078]);
        PgConstante::create(['pg' => 'Sd Eng', 'pg_abrev' => 'SOLDADO DO EXERCITO', 'adic_mil' => 13, 'soldo' => 1765]);
        PgConstante::create(['pg' => 'Sd Rcr', 'pg_abrev' => 'SOLDADO RECRUTA', 'adic_mil' => 0, 'soldo' => 1078]);
        PgConstante::create(['pg' => 'TF Mor', 'pg_abrev' => 'TAIFEIRO-MOR', 'adic_mil' => 13, 'soldo' => 2627]);
        PgConstante::create(['pg' => 'TF 1Cl', 'pg_abrev' => 'TAIFEIRO 1 CL', 'adic_mil' => 13, 'soldo' => 2325]);
        PgConstante::create(['pg' => 'TF 2Cl', 'pg_abrev' => 'TAIFEIRO 2 CL', 'adic_mil' => 13, 'soldo' => 2210]);
    }
}
