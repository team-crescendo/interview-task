## Forte Test 

안녕하세요, 포르테 개발자 미션(과제) 브랜치에 오신걸 환영합니다.
<br>
기본적인 프로그래밍 능력을 보기 위해 테스트를 진행합니다.

### 과제 제한사항 안내

- Laravel Framework 6 (PHP 7.3 이상)
- MVC 패턴을 이용하여 과제를 수행해도 됩니다.
    - Service Layer 를 이용하신다면 가산점이 부여됩니다.

그 외 제한사항은 없습니다.

### 과제 방법

1. 해당 Repo 를 fork 합니다.
2. code 브랜치를 생성합니다.
3. 라라벨 프로젝트의 **초기 커밋**을 진행한 뒤, 커밋은 작은 문제 해결 단위로 작성합니다.
4. 과제를 해결을 하셨다면 저희에게 알려주세요. (팀 크레센도 CAST 서버)

### 과제 제출 후

제출 후 예정된 인터뷰에 참여해주세요. <br>
인터뷰는 작성하신 코드를 기반으로 리뷰를 통해 진행됩니다.

---

## 과제 안내 

라라벨 프레임워크를 이용한 API 서버 개발입니다.

### 과제 설명

- Todo API: https://jsonplaceholder.typicode.com/todos

1. Todo Crawling
    - `Todo API`의 응답받은 정보들을 가져와 데이터베이스에 저장합니다.
    - Laravel Artisan Command 이용해 구현을 해주세요. (자유)
    - 테이블 명: `todos` (migration)
    - `todos`의 필드 규격은 `Todo API`와 동일하게 생성합니다.
2. Todo API
    - `todos`의 데이터를 이용하여 Create/Read/Update/Delete (CRUD) 를 구현해주세요.
3. Todo CSV 다운로드 API
    - 모든 Todo 데이터를 이용하여 `Todo API`의 규격에 맞는 CSV 파일을 생성합니다.
4. Todo 검색 기능 API
    - `title`, `completed` 검색 기능을 구현해주세요. 
        - ex) completed equals true
        - ex) title LIKE '%forte%' OR completed equals false
        - ex) title LIKE 'kevin%' AND completed equals true
    - 조건에 만족하는 결과가 없다면 에러를 반환합니다.
