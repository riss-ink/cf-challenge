
# Cardinal Financial Coding Challenge

This is a coding challenge for Cardinal Financial written by me(Amaris Ink)



## Challenge Objectives
Use the Laravel framework to build a simple poll feature. Any frontend framework/scaffolding or packages may be used.

The poll feature must contain the following:

- An admin list screen is required to display a table of polls and a link in each row to edit the post and view poll responses. A button should be present to allow a user to navigate to the screen to add a new poll.
- Add and edit screens are required to add new polls and update existing polls, this screen should be validated against the tables required fields.
- Once a poll is published, i.e. the current date and time is within the start_date and finish_date range, the poll should not be editable.
- A user-facing interface is required to display a given poll and it should allow a user to submit their response to the poll.
- Editors should be able to add multiple polls to the user-facing interface in any order they would like.
- Once a user has submitted a response to the poll, the aggregated poll results should be displayed showing how many users voted for each option.
- A user can only vote once per poll.
- Please provide any documentation on how to get started with reviewing your code, for example if the database needs to be seeded or if any unit tests should be run.

## Tech Stack

**Client:** VueJs, Vite, TailwindCSS

**Server:** PHP, Laravel, Intertia


## Installation

```bash
    alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
    sail up
    sail artisan migrate --seed
    sail npm run build
    sail npm run dev
```
url should be localhost
## Process

I chose to use Vuejs and Intertia with this project. Not only is this the stack I'm most comfortable with, but also Neil mentioned not being super familar with it so I thought this would be a nice little showcase of how it works. I set up the blank application using Laravel Jetstream.
