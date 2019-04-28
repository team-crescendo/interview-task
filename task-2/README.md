## Second Task

### 사용 언어
- Laravel 5.6 이상 (PHP Framework)

### 내용
데이터를 가공하여 제공해주세요.
<br>
해당 과제는 세번째 과제(task-3)와 연관되어 있습니다.
<br>
1. 아래의 데이터(books.json) 에 같은 `category` 의 `price` 를 모두 합쳐 `result1.json` 에 저장해주세요.
2. 같은 `category` 의 `name` 을 컴마로 구분하여 `result2.json` 에 저장해주세요. 단, 순서는 id 기준으로 내림차순입니다.
3. 라라벨 아티즌 커맨드로 만들어 위 1,2 번을 실행해주세요. (라우트를 파서 메서드 접근 X)

### 조건
- `BookController` 에 `convertCategoriesPrice()` 메서드를 만들어 1번을 구현 해주세요.
- `BookController` 에 `mergeCategoriesName()` 메서드를 만들어 2번을 구현 해주세요.
- 커맨드 명은 `BookUpdater` 로 해주시고, 콘솔 커맨드는 `php artisan book:update` 로 실행 가능하게 해주세요.

### 파일 안내
`books.json`, `result1.json`, `result2.json` 은 `public/forte` 경로를 생성하여 넣어주세요.

```json
[
    {
        "id": 4,
        "name": "Laravel5 by kevin",
        "category": "Programming",
        "price": "18500"
    }, {
        "id": 1,
        "name": "SkileBot Stock Tips",
        "category": "Stock",
        "price": "40000"
    }, {
        "id": 3,
        "name": "Design Master Way",
        "category": "Design",
        "price": "20000"
    }, {
        "id": 2,
        "name": "Forte API Documentation",
        "category": "Programming",
        "price": "500"
    }, {
        "id": 6,
        "name": "Crescendo Music Notation Editor",
        "category": "Programming",
        "price": "18500"
    }, {
        "id": 5,
        "name": "Draw Book",
        "category": "Design",
        "price": "2050"
    }, {
        "id": 7,
        "name": "Seoul Tour",
        "category": "Tour",
        "price": "9000"
    }, {
        "id": 8,
        "name": "Gangnam Around Bus Tour Tips",
        "category": "Tour",
        "price": "41000"
    }
]
```