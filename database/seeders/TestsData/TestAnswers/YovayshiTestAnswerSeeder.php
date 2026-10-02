<?php

namespace Database\Seeders\TestsData\TestAnswers;

class YovayshiTestAnswerSeeder extends TestAnswerSeeder
{
    /**
     * [
     *    Group => [
     *       Question number => [
     *          Answer text,
     *          Test base codes,
     *       ]
     *    ]
     * ]
     */
    private $answers = [
        [
            1 => [
                [
                    'text' => 'Цвет, совершенство форм',
                    'test_base_codes' => ['art_sphere'],
                ],
                [
                    'text' => 'Их внутреннее устройство (как и из чего они сделаны)',
                    'test_base_codes' => ['material_sphere'],
                ],
            ],
            2 => [
                [
                    'text' => 'Дружелюбие, чуткость, отсутствие корысти',
                    'test_base_codes' => ['people_sphere'],
                ],
                [
                    'text' => 'Мужество, смелость, выносливость',
                    'test_base_codes' => ['physical_sphere'],
                ],
            ],
            3 => [
                [
                    'text' => 'Создавать такую технику, которой можно было бы самим пользоваться в быту',
                    'test_base_codes' => ['tech_sphere'],
                ],
                [
                    'text' => 'И впредь развивать эту отрасль, чтобы всесторонне обслуживать людей',
                    'test_base_codes' => ['material_sphere'],
                ],
            ],
            4 => [
                [
                    'text' => 'За научное изобретение',
                    'test_base_codes' => ['mental_sphere'],
                ],
                [
                    'text' => 'За общественную деятельность',
                    'test_base_codes' => ['material_sphere'],
                ],
            ],
            5 => [
                [
                    'text' => 'Сложность ходьбы, грациозность участников парада',
                    'test_base_codes' => ['art_sphere'],
                ],
                [
                    'text' => 'Внешнее оформление колонн (знамена, одежда и пр.)',
                    'test_base_codes' => ['physical_sphere'],
                ],
            ],
            6 => [
                [
                    'text' => 'Общественной работой (на добровольных началах)',
                    'test_base_codes' => ['people_sphere'],
                ],
                [
                    'text' => 'Чем-либо практическим (ручным трудом)',
                    'test_base_codes' => ['physical_sphere'],
                ],
            ],
            7 => [
                [
                    'text' => 'Новинок научной аппаратуры (в области физики, химии, биологии)',
                    'test_base_codes' => ['tech_sphere'],
                ],
                [
                    'text' => 'Новых продовольственных товаров',
                    'test_base_codes' => ['material_sphere'],
                ],
            ],
            8 => [
                [
                    'text' => 'Музыкальный',
                    'test_base_codes' => ['art_sphere'],
                ],
                [
                    'text' => 'Технический',
                    'test_base_codes' => ['tech_sphere'],
                ],
            ],
            9 => [
                [
                    'text' => 'На сплоченность коллектива',
                    'test_base_codes' => ['people_sphere'],
                ],
                [
                    'text' => 'На создание необходимых удобств',
                    'test_base_codes' => ['material_sphere'],
                ],
            ],
            10 => [
                [
                    'text' => 'Литературно-художественные',
                    'test_base_codes' => ['art_sphere'],
                ],
                [
                    'text' => 'Научно-популярные',
                    'test_base_codes' => ['tech_sphere'],
                ],
            ],
            11 => [
                [
                    'text' => 'Жить без некоторых удобств, но иметь возможность пользоваться сокровищницей искусства, создавать искусство',
                    'test_base_codes' => ['art_sphere'],
                ],
                [
                    'text' => 'Создавать себе благополучный, удобный быт',
                    'test_base_codes' => ['material_sphere'],
                ],
            ],
            12 => [
                [
                    'text' => 'Техника',
                    'test_base_codes' => ['tech_sphere'],
                ],
                [
                    'text' => 'Правосудие',
                    'test_base_codes' => ['mental_sphere'],
                ],
            ],
            13 => [
                [
                    'text' => 'О развитии науки в нашей стране',
                    'test_base_codes' => ['mental_sphere'],
                ],
                [
                    'text' => 'О достижениях спортсменов нашей страны',
                    'test_base_codes' => ['physical_sphere'],
                ],
            ],
            14 => [
                [
                    'text' => 'О машине нового типа',
                    'test_base_codes' => ['tech_sphere'],
                ],
                [
                    'text' => 'О новой научной теории',
                    'test_base_codes' => ['mental_sphere'],
                ],
            ],
            15 => [
                [
                    'text' => 'Работа с машинами',
                    'test_base_codes' => ['tech_sphere'],
                ],
                [
                    'text' => 'Работа, связанная с постоянными передвижениями (агроном, лесничий, дорожный мастер)',
                    'test_base_codes' => ['physical_sphere'],
                ],
            ],
            16 => [
                [
                    'text' => 'Подготовить учащихся к работе с людьми, чтобы они могли помогать другим создавать материальные блага',
                    'test_base_codes' => ['people_sphere'],
                ],
                [
                    'text' => 'Подготовить учащихся к практической деятельности, к умению создавать материальные блага',
                    'test_base_codes' => ['mental_sphere'],
                ],
            ],
            17 => [
                [
                    'text' => 'То, что они несут людям искусство и красоту',
                    'test_base_codes' => ['art_sphere'],
                ],
                [
                    'text' => 'То, что они выполняют общественно полезную работу',
                    'test_base_codes' => ['people_sphere'],
                ],
            ],
            18 => [
                [
                    'text' => 'Физика',
                    'test_base_codes' => ['tech_sphere'],
                ],
                [
                    'text' => 'Физическая культура',
                    'test_base_codes' => ['physical_sphere'],
                ],
            ],
            19 => [
                [
                    'text' => 'Изучение поведения людей',
                    'test_base_codes' => ['people_sphere'],
                ],
                [
                    'text' => 'Забота о благосостоянии граждан',
                    'test_base_codes' => ['mental_sphere'],
                ],
            ],
            20 => [
                [
                    'text' => 'Работу с книгами в библиотеке',
                    'test_base_codes' => ['mental_sphere'],
                ],
                [
                    'text' => 'Работу на свежем воздухе в экспедиции',
                    'test_base_codes' => ['physical_sphere'],
                ],
            ],
            21 => [
                [
                    'text' => 'Опытам по физике, химии',
                    'test_base_codes' => ['tech_sphere'],
                ],
                [
                    'text' => 'Занятиям по литературе',
                    'test_base_codes' => ['mental_sphere'],
                ],
            ],
            22 => [
                [
                    'text' => 'Как известный специалист по внешней торговле с целью покупки необходимых товаров для нашей страны',
                    'test_base_codes' => ['people_sphere'],
                ],
                [
                    'text' => 'Как известный спортсмен на международные соревнования',
                    'test_base_codes' => ['physical_sphere'],
                ],
            ],
            23 => [
                [
                    'text' => 'О выдающихся художниках',
                    'test_base_codes' => ['art_sphere'],
                ],
                [
                    'text' => 'О выдающихся ученых',
                    'test_base_codes' => ['mental_sphere'],
                ],
            ],
            24 => [
                [
                    'text' => 'Прекрасный литературный стиль',
                    'test_base_codes' => ['art_sphere'],
                ],
                [
                    'text' => 'Яркое изображение смелости и храбрости героев',
                    'test_base_codes' => ['physical_sphere'],
                ],
            ],
            25 => [
                [
                    'text' => 'Физической культуре или другой работе, связанной с движением',
                    'test_base_codes' => ['physical_sphere'],
                ],
                [
                    'text' => 'Работе малоподвижной, но связанной с созданием новой техники',
                    'test_base_codes' => ['material_sphere'],
                ],
            ],
            26 => [
                [
                    'text' => 'Поповым и Циолковским',
                    'test_base_codes' => ['tech_sphere'],
                ],
                [
                    'text' => 'Менделеевым и Павловым',
                    'test_base_codes' => ['mental_sphere'],
                ],
            ],
            27 => [
                [
                    'text' => 'На спорт, так как это нужно для укрепления здоровья',
                    'test_base_codes' => ['physical_sphere'],
                ],
                [
                    'text' => 'На успеваемость учащихся, так как это необходимо для будущего',
                    'test_base_codes' => ['material_sphere'],
                ],
            ],
            28 => [
                [
                    'text' => 'Сообщение о состоявшейся художественной выставке',
                    'test_base_codes' => ['art_sphere'],
                ],
                [
                    'text' => 'Известие о прошедшем митинге в защиту прав человека',
                    'test_base_codes' => ['people_sphere'],
                ],
            ],
            29 => [
                [
                    'text' => 'Главного инженера завода',
                    'test_base_codes' => ['tech_sphere'],
                ],
                [
                    'text' => 'Директора универмага',
                    'test_base_codes' => ['people_sphere'],
                ],
            ],
            30 => [
                [
                    'text' => 'Много знать',
                    'test_base_codes' => ['mental_sphere'],
                ],
                [
                    'text' => 'Создавать материальные блага',
                    'test_base_codes' => ['material_sphere'],
                ],
            ],
        ],
    ];

    public function __construct()
    {
        return parent::__construct('yovayshi');
    }

    public function run(): void
    {
        $this->setAnswers($this->answers);
    }
}
