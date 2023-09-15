// @ts-ignore
// Remove ^ when we start scheduling tasks so it doesn't error out
import Scheduler from '@ioc:Verful/Scheduler';

/*
|--------------------------------------------------------------------------
| Scheduled tasks
|--------------------------------------------------------------------------
| Repo: https://github.com/verful/adonis-scheduler
|
| Scheduled tasks allow you to run recurrent tasks in the background of your
| application. Here you can define all your scheduled tasks.
|
| You can define a scheduled task using the `.call` method on the Scheduler object
| as shown in the following example
|
| ```
| 	Scheduler.call(() => {
|			console.log('I am a scheduled task')
| 	}).everyMinute()
| ```
|
| The example above will print the message `I am a scheduled task` every minute.
|
| You can also schedule ace commands using the `.command` method on the Scheduler
| object as shown in the following example
|
| ```
| 	Scheduler.command('greet').everyMinute()
| ```
|
| The example above will run the `greet` command every minute.
|
| You can also schedule shell commands with arguments using the `.exec` method on the Scheduler
| object as shown in the following example
|
| ```
| 	Scheduler.exec('node ace greet').everyMinute()
| ```
|
| The example above will run the `node ace greet` command every minute.
|
| Happy scheduling!
*/
