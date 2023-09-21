# SaaS Starter

> Adonis v5 starter for NiftyCo SaaS applications

## Getting Started

To utilize this repository run the following commands

```sh
npx groundwork@latest aniftyco/saas-starter my-app
```

This will clone the repo and get the project setup locally using [`groundwork`](https://github.com/aniftyco/groundwork).

Once that's done, you can go into your directory and install dependencies.

```sh
cd my-app && npm install
```

After that make sure to copy the `.env.example` file into your own `.env` file or Adonis will not startup.

```sh
cp .env.example .env
```

Now you can generate an `APP_KEY` by running the following command

```sh
node ace generate:key
```

**Optionally:** You can migrate and seed the database.

```sh
node ace migration:run --seed
```

Now start the application and go to [http://localhost:3333](http://localhost:3333) to see your app.

```sh
npm start
```
