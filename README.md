## First Setup 

Step to develop code from your computer:
1. open terminal

2. git clone https://github.com/joshuajevon/Takurui.git (in your terminal)

3. don't forget to add env file setup on your project

4. npm run install:env (in your terminal) -> make sure your node version > 18

![image](https://user-images.githubusercontent.com/90315898/212232429-a09cd204-bc03-4f5a-b20f-a4faedf92571.png)

after vite was build like this don't close this terminal

5. add your new terminal for "php artisan serve"

Your application is ready to serve, and if you want to start again just make sure u had two different terminal
first terminal for "npm run build"
second terminal for php artisan serve


**Semantic Branching**
```bash
# format
<type>/<feature-title>/<sub-title>/<feature-number>/<date>

# example
main
stable/2021-12-24
development
experiment/2021-12-24

feature/register
hotfix/register/password-validation

page/home
section/home/about-us
```

`<type>`: main, test, stable, release, experimental, hotfix, bugfix, feature, page, section

**Semantic Committing & Merging**

```bash
# format
[<status>](<scope>) <section-name|page-name>: <changes description>
[<status>] <section-name|page-name>: <changes description>
<status|scope>: <changes description>

# example
[add](feat) about-us in home: put assets and give styling to about us
feat: put assets and give styling to about us
[fix] register: fix password validation logic 
```

`<status>`: init, add, patch, enable, disable, fix, bugfix, hotfix refactor, remove, merge. \
`<scope>` : test, doc, conflict, feat, section, mixed \
`<scope>` (FE): api, page, section, style, asset, util, logic, etc. \


