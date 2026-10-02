<?php

namespace Database\Seeders;

use App\Models\Employment;
use App\Models\Vacancy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VacancySeeder extends Seeder
{
    private array $vacancies = [
        [
            'title' => 'Автослесарь',
            'salary' => 55000.00,
            'description' => 'Осуществляет техническое обслуживание, разборку, ремонт, замену, сварку и регулировку узлов автомобилей; оппоновку, проем, маяку, чистку и охазку деталей, зачистку заусенки, смену тормозных колодок, сцепления, масел',
            'contact' => 'atp@transport.ru / +7 (495) 555-12-34',
            'employment_codes' => ['autoslesar']
        ],
        [
            'title' => 'Агент по продажам недвижимости',
            'salary' => 95000.00,
            'description' => 'Производит поиск и обслуживание клиентов, формирует спрос - рекламирует товары или услуги. Рабочий день не нормирован, разъездная работа в свободном режиме',
            'contact' => 'realty@estate.ru',
            'employment_codes' => ['agent_po_prodazham_nedvizhimosti', 'agent_torgovyy']
        ],
        [
            'title' => 'Менеджер по рекламе',
            'salary' => 67500.00,
            'description' => 'Осуществляет в качестве посредника работу по представлению и продвижению товаров, услуг, комплексных идей, выполнение комплексов мер направленных на содействие их реализации или достижение других маркетинговых задач',
            'contact' => 'adv@agency.ru',
            'employment_codes' => ['agent_reklamny', 'prouoter']
        ],
        [
            'title' => 'Страховой агент',
            'salary' => 59000.00,
            'description' => 'Осуществляет разъяснение клиентам возможности и преимущества того или иного вида страхования, оформляет страховые документы',
            'contact' => 'insurance@company.ru',
            'employment_codes' => ['agent_strahovoy', 'agent_torgovyy']
        ],
        [
            'title' => 'Торговый представитель',
            'salary' => 63500.00,
            'description' => 'Осуществляет ведение переговоров о заключении сделок купли-продажи, заключает сделки купли-продажи от своего имени или другого представляемого лица на основе договора, регулирующего отношения между ними',
            'contact' => 'sales@trade.ru / +7 (495) 777-88-99',
            'employment_codes' => ['agent_torgovyy', 'agent_po_prodazham_nedvizhimosti']
        ],
        [
            'title' => 'Дежурный администратор',
            'salary' => 42500.00,
            'description' => 'Осуществляет прием клиентов, их регистрацию, расчеты за предоставленные услуги, оформляет необходимую документацию',
            'contact' => 'hotel@reservation.ru',
            'employment_codes' => ['administrator_dezhurnyy', 'dispetcher_na_telefone']
        ],
        [
            'title' => 'Администратор торгового зала',
            'salary' => 47500.00,
            'description' => 'Осуществляет контроль над работниками торгового зала, организует обслуживание клиентов, решает конфликтные ситуации',
            'contact' => 'shop@retail.ru',
            'employment_codes' => ['administrator_zala_torgovogo', 'supervayzer']
        ],
        [
            'title' => 'Администратор салона',
            'salary' => 48500.00,
            'description' => 'Осуществляет работу по эффективному и культурному обслуживанию посетителей, созданию комфортных условий. Консультирует посетителей по вопросам, касающимся оказываемых услуг',
            'contact' => 'salon@beauty.ru',
            'employment_codes' => ['administrator_salona', 'administrator_dezhurnyy']
        ],
        [
            'title' => 'Online-редактор',
            'salary' => 85000.00,
            'description' => 'Работает на телевидении и в телекоммуникационных компаниях по подготовке короткой, конкретной и интересно поданной информации разнообразного содержания, в режиме реального времени',
            'contact' => 'media@tv.ru',
            'employment_codes' => ['online_redaktor', 'sayta_menedzher']
        ],
        [
            'title' => 'Офис-менеджер',
            'salary' => 52500.00,
            'description' => 'Организует работу офиса, принимает посетителей, руководит работой персонала офиса, осуществляет административные и хозяйственные функции',
            'contact' => 'office@company.ru',
            'employment_codes' => ['ofis_menedzher', 'administrator_dezhurnyy', 'dokumentoved']
        ],
        [
            'title' => 'Пробидер (специалист по металлам)',
            'salary' => 75000.00,
            'description' => 'Определяет пробы драгоценных металлов (определяет количественный и качественный состав примесей) в организациях по обработке драгоценных металлов',
            'contact' => 'lab@metall.ru',
            'employment_codes' => ['probider']
        ],
        [
            'title' => 'Промоутер',
            'salary' => 35000.00,
            'description' => 'Продвигает какой-либо товар или услугу, проводит презентации и раздачу рекламных материалов',
            'contact' => 'promo@agency.ru',
            'employment_codes' => ['prouoter', 'stendist']
        ],
        [
            'title' => 'Рекрутер',
            'salary' => 72500.00,
            'description' => 'Находит работодателей, имеющих вакансии, заинтересованных в наборе персонала, заключает договоры',
            'contact' => 'hr@staffing.ru',
            'employment_codes' => ['rekruter', 'agent_torgovyy']
        ],
        [
            'title' => 'Сайт-менеджер',
            'salary' => 100000.00,
            'description' => 'Отслеживает спрос на продаваемые товары, контролирует сделки, которые осуществляют представители отделов продаж, проводит риск-анализ клиентов-покупателей',
            'contact' => 'ecom@shop.ru',
            'employment_codes' => ['sayta_menedzher', 'online_redaktor', 'agent_torgovyy']
        ],
        [
            'title' => 'Сомелье',
            'salary' => 90000.00,
            'description' => 'Работает в ресторанах и магазинах, являясь специалистом по винам. Знает ассортимент и подбирает вина по вкусу клиента',
            'contact' => 'restaurant@wine.ru',
            'employment_codes' => ['somelye']
        ],
        [
            'title' => 'Стендист',
            'salary' => 45000.00,
            'description' => 'Работает на выставках и в торговых центрах у стендов с рекламной информацией о той или иной компании',
            'contact' => 'expo@event.ru',
            'employment_codes' => ['stendist', 'prouoter']
        ],
        [
            'title' => 'Супервайзер',
            'salary' => 67500.00,
            'description' => 'Осуществляет контроль и надзор за деятельностью различных объектов, как производственных, так и торговых. Привлекается для проведения экспертизы деятельности объекта',
            'contact' => 'control@supervise.ru',
            'employment_codes' => ['supervayzer', 'zaveduyushchiy_otdelom']
        ],
        [
            'title' => 'Диспетчер',
            'salary' => 39000.00,
            'description' => 'Осуществляет прием и передачу информации, фиксирование ее в журнал с обозначением адресата',
            'contact' => 'dispatch@service.ru',
            'employment_codes' => ['dispetcher_na_telefone', 'administrator_dezhurnyy']
        ],
        [
            'title' => 'Документовед',
            'salary' => 48500.00,
            'description' => 'Организует информационные потоки предприятия или учреждения, занимается делопроизводством',
            'contact' => 'doc@archive.ru',
            'employment_codes' => ['dokumentoved', 'ofis_menedzher']
        ],
        [
            'title' => 'Заведующий отделом',
            'salary' => 105000.00,
            'description' => 'Организует выполнение работ, предусмотренных в тематическом плане учреждения или отдела (отделения, лаборатории)',
            'contact' => 'head@department.ru',
            'employment_codes' => ['zaveduyushchiy_otdelom', 'supervayzer']
        ],
    ];
    
    public function run(): void
    {
        foreach ($this->vacancies as $vacancy) {
            $vacancyInstance = Vacancy::create([
                'title' => $vacancy['title'],
                'salary' => $vacancy['salary'],
                'description' => $vacancy['description'],
                'contact' => $vacancy['contact'],
            ]);

            foreach ($vacancy['employment_codes'] as $employmentCode) {
                $employment = Employment::where('code', $employmentCode)->first();
        
                if (!$employment) continue;

                $employment->vacancies()->attach($vacancyInstance);
            }
        }
    }
}
