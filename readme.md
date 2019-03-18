# IP2 API
RESTful API for IP2 Android application, created with Lumen Framework. Hosted using Heroku Cloud.
API Url = https://ip2-api.herokuapp.com (might not be available, run out of Heroku Cloud free plan)
# Endpoints
## Get ban reason
```
GET: /api/blacklist/{id}
```
Response positive:
```
Status: 200,
{
    UserID: number,
    BanReason: string
}
```
Response negative
```
Status: 404,
[]
```
## Crate new ban
```
POST: /api/blacklist
```
Body required
```
{
   userid: number,
   reason: string
}
```
Response positive:
```
Status: 201,
[]
```
Response negative
```
Status: 500,
[]
```
## Delete a ban
```
DELETE: /api/blacklist/{id}
```
Response positive:
```
Status: 200,
[]
```
Response negative
```
Status: 500,
[]
```
## Get all featured quizes
```
GET: /api/featuredQuiz
```
Response:
```
Status: 200,
[
    {
        FeatureID: number,
        QuizID: number
    }
    {}, {}, ...
]
```
## Get single featured quiz
```
GET: /api/featuredQuiz/{id}
```
Response Positive:
```
Status: 200,
[
    {
        FeatureID: number,
        QuizID: number
    }
]
```
Response Negative:
```
Status: 404,
[]
```
## Add single question
```
POST: /api/question
```
Body required
```
{
   quizid: string,
   questionstring: string,
   questionimage: string,
   correctanswerstring: string,
   wronganswerstring: string,
   wronganswerstring2: string,
   wronganswerstring3: string
}
```
Response positive:
```
Status: 201,
[]
```
Response negative
```
Status: 500,
[]
```
## Add multiple question
```
POST: /api/question/many
```
Body required
```
{
   quizid: string,
   questions: [
      {
         questionstring: string,
         questionimage: string,
         correctanswerstring: string,
         wronganswerstring: string,
         wronganswerstring2: string,
         wronganswerstring3: string
      }, {}, {}, ...
   ]

}
```
Response positive:
```
Status: 201,
[]
```
Response negative
```
Status: 500,
[]
```
## Edit question
```
PUT: /api/question/{id}
```
Body Requried (all parameters are optional):
```
{
   questionstring?: string,
   questionimage?: string,
   correctanswerstring?: string,
   wronganswerstring?: string,
   wronganswerstring2?: string,
   wronganswerstring3?: number
}
```
Response Positive:
```
Status: 200,
[]
```
Response Negative if question not found:
```
Status: 404,
[]
```
Response Negative otherwise:
```
Status 500,
[]
```
## Delete a question
```
DELETE: /api/question/{id}
```
Response positive:
```
Status: 200,
[]
```
Response negative
```
Status: 500,
[]
```
## Get all quizes
```
GET: /api/quiz
```
Response:
```
Status: 200,
[
    {
        QuizID: number,
        QuizDescription: string,
        QuizImage: string,
        QuizName: string
    }
    {}, {}, ...
]
```
## Get single quiz
```
GET: /api/quiz/{id}
```
Response Positive:
```
Status: 200,
[
    {
        QuizID: number,
        QuizDescription: string,
        QuizImage: string,
        QuizName: string
    }
]
```
Response Negative:
```
Status: 404,
[]
```
## Get questions for quiz
```
POST: /api/quiz/{id}/questions
```
Response Positive:
```
Status: 200,
[
    {
        QuestionID: number,
        CorrectAnswerString: string,
        QuestionString: string,
        QuizID: number,
        WrongAnswerString: string,
        WrongAnswerString2: string,
        WrongAnswerString3: number
    }, 
    {}, {}, ...
]
```
Response Negative:
```
Status: 404,
[]
```
## Edit quiz
```
POST: /api/quiz/{id}/edit
```
Body Requried (all parameters are optional):
```
{
   quiznam?: string,
   quizdescription?: string,
   quizimage?: string,
   quizcolor?: string
}
```
Response Positive:
```
Status: 200,
[]
```
Response Negative if quiz not found:
```
Status: 404,
[]
```
Response Negative otherwise:
```
Status 500,
[]
```
## Add new quiz
```
POST: /api/quiz
```
Body required
```
{
   quizname: string,
   quizdescription: string,
   quizimage: string,
   quizcolor: string
}
```
Response positive:
```
Status: 201,
id:number
```
Response negative
```
Status: 500,
[]
```
## Delete a quiz
```
DELETE: /api/quiz/{id}
```
Response positive:
```
Status: 200,
[]
```
Response negative
```
Status: 500,
[]
```
## Get user's recent Quizzes
```
GET: /api/recentQuiz/{id}
```
Response Positive:
```
Status: 200,
[
    {
        RecentID: number,
        QuizID: number,
        UserID: number,
        Score: number,
        Time: timestamp
    }
]
```
Response Negative:
```
Status: 404,
[]
```
## Add new Recent Quiz
```
POST: /api/recentQuiz
```
Body Requried:
```
{
   quizid: number,
   userid: number,
   score: number
}
```
Response Positive:
```
Status: 201,
[
   {
      RecentID: number,
      QuizID: number,
      UserID: number,
      Score: number,
      Time: timestamp
       
   }
]
```
Response Negative:
```
Status: 500,
[]
```
## Get all users
```
GET: /api/user
```
Response:
```
Status: 200,
[
    {
        UserID: number,
        Username: string,
        Email: string,
        Firstname: string,
        Surname: string,
        Password: string,
        AdminStatus: number,
        XP: number,
        QuizzessCompleted: number,
        CorrectAnswers: number
    }
    {}, {}, ...
]
```
### Adding params when getting all users
```
GET: /api/user?term={term}&order={order}&limit={limit}

term - name of column in User table
order - asc or desc
limit - any positive number

Ex: /api/user?term=Username&order=asc&limit=10
```
Response positive:
```
Status: 200,
[
    {
        UserID: number,
        Username: string,
        Email: string,
        Firstname: string,
        Surname: string,
        Password: string,
        AdminStatus: number,
        XP: number,
        QuizzessCompleted: number,
        CorrectAnswers: number
    }
    {}, {}, ...
]
```
Response Negative:
```
Status: 400,
[]
```
## Get single user
```
GET: /api/user/{id}
```
Response Positive:
```
Status: 200,
[
    {
        UserID: number,
        Username: string,
        Email: string,
        Firstname: string,
        Surname: string,
        Password: string,
        AdminStatus: number,
        XP: number,
        QuizzessCompleted: number,
        CorrectAnswers: number
    }
]
```
Response Negative:
```
Status: 404,
[]
```
## Get user ranking position
```
GET: /api/user/{id}/ranking
```
Response Positive:
```
Status: 200,
{
   position: number
}
```
Response Negative:
```
Status: 400,
[]
```
## Get user friends
```
GET: /api/user/{id}/friends
```
Response Positive:
```
Status: 200,
[
    {
        User2ID: number
    }, {}, {}, ...
]
```
Response Negative:
```
Status: 404,
[]
```
## Check if username or email taken
```
POST: /api/user/find
```
Body Required:
```
{
   type:string ('email' or 'username'),
   term: string (email or username itself: 'Username1')
}
```
Response Positive (if email/username is not taken):
```
Status: 404,
[]
```
Response Negative if email is taken:
```
Status: 200,
[
    {
        UserID: number,
        Username: string,
        Email: string,
        Firstname: string,
        Surname: string,
        Password: string,
        AdminStatus: number,
        XP: number,
        QuizzessCompleted: number,
        CorrectAnswers: number
    }
]
```
Response Negative if request body incorrect:
```
Status: 400,
[]
```
## Login user
```
POST: /api/user/login
```
Body Required:
```
{
   email:string,
   password: string
}
```
Response Positive:
```
Status: 200,
[
    {
        UserID: number,
        Username: string,
        Email: string,
        Firstname: string,
        Surname: string,
        Password: string,
        AdminStatus: number,
        XP: number,
        QuizzessCompleted: number,
        CorrectAnswers: number
    }
]
```
Response Negative if email not found:
```
Status: 404,
[]
```
Response Negative if passwords don't match or body not correct:
```
Status: 400,
[]
```
## Register user
```
POST: /api/user/register
```
Body Requried:
```
{
   username: string,
   email: string,
   firstname: string,
   surname: string,
   password: string
}
```
Response Positive:
```
Status: 201,
[
    {
        UserID: number,
        Username: string,
        Email: string,
        Firstname: string,
        Surname: string,
        Password: string,
        AdminStatus: number,
        XP: number,
        QuizzessCompleted: number,
        CorrectAnswers: number
    }
]
```
Response Negative:
```
Status: 500,
[]
```
## Edit user
```
POST: /api/user/{id}/edit
```
Body Requried (all parameters are optional):
```
{
   username?: string,
   email?: string,
   firstname?: string,
   surname?: string,
   password?: string,
   adminstatus?: number,
   xp?: number,
   quizesscompleted?: number,
   correctanswers?: number,
   profileimage?: string
}
```
Response Positive:
```
Status: 200,
[]
```
Response Negative if user not found:
```
Status: 404,
[]
```
Response Negative otherwise:
```
Status 500,
[]
```
