@extends('layouts.marketing')

@section('title', 'Your SaaS landing page')

@php
  $features = [
      ['icon' => 'briefcase', 'title' => 'Rock Solid Framework', 'description' => 'Laravel is the greatest.'],
      ['icon' => 'briefcase', 'title' => 'Rock Solid Framework', 'description' => 'Laravel is the greatest.'],
      ['icon' => 'briefcase', 'title' => 'Rock Solid Framework', 'description' => 'Laravel is the greatest.'],
      ['icon' => 'briefcase', 'title' => 'Rock Solid Framework', 'description' => 'Laravel is the greatest.'],
      ['icon' => 'briefcase', 'title' => 'Rock Solid Framework', 'description' => 'Laravel is the greatest.'],
      ['icon' => 'briefcase', 'title' => 'Rock Solid Framework', 'description' => 'Laravel is the greatest.'],
  ];

  $brands = ['digg', 'ebay', 'fedex', 'ibm', 'lenovo'];

  $plans = [
      [
          'name' => 'Hobby',
          'popular' => false,
          'price' => '14.95',
          'description' => 'The essentials to provide your best work for clients.',
          'features' => ['5 products', 'Up to 1,000 subscribers', 'Basic analytics', '48-hour support response time'],
      ],
      [
          'name' => 'Pro',
          'popular' => true,
          'price' => '49.95',
          'description' => 'A plan that scales with your rapidly growing business.',
          'features' => [
              '25 products',
              'Up to 10,000 subscribers',
              'Advanced analytics',
              '24-hour support response time',
              'Marketing automations',
          ],
      ],
      [
          'name' => 'Startup',
          'popular' => false,
          'price' => '99.95',
          'description' => 'Dedicated support and infrastructure for your company.',
          'features' => [
              'Unlimited products',
              'Unlimited subscribers',
              'Advanced analytics',
              '1-hour, dedicated support response time',
              'Marketing automations',
              'Custom integrations',
          ],
      ],
  ];

  $faqs = [
      ['question' => 'How do you make holy water?', 'answer' => 'You boil the hell out of it.'],
      [
          'question' => 'What\'s the best thing about Switzerland?',
          'answer' => 'I don\'t know, but the flag is a big plus.',
      ],
      ['question' => 'What do you call someone with no body and no nose?', 'answer' => 'Nobody knows.'],
      ['question' => 'Why do you never see elephants hiding in trees?', 'answer' => 'Because they\'re so good at it.'],
  ];
@endphp

@section('content')
  {{-- Hero --}}
  <section class="mx-auto flex w-full max-w-3xl flex-col space-y-4 text-gray-800">
    <h1 class="text-center text-7xl font-bold tracking-tight">Marketing for your nifty <span class="text-primary-600">SaaS
        Application</span></h1>
    <h2 class="py-4 text-lg font-medium">{{ env('APP_NAME') }} is powered by a starter kit for early stage SaaS startups.
      Built with AdonisJS, Tailwind CSS, HTMX and AlpineJS. You can quickly create any SaaS with this starter.</h2>
    <div class="flex items-center justify-center space-x-4">
      <a class="bg-primary-600 hover:bg-primary-500 text-primary-50/90 rounded-md px-4 py-2 font-medium"
        href="{{ url('/') }}"
      >Start your 7 day free trial</a>
      <a class="font-semibold" href="#">Learn more →</a>
    </div>
  </section>

  {{--  Features  --}}
  <section class="mt-24 text-gray-800">
    <a id="features"></a>
    <p class="text-center text-5xl font-bold tracking-tight">Everything you need to start a SaaS</p>
    <p class="mt-4 text-center text-lg text-slate-600">{{ env('APP_NAME') }} comes batteries included. It takes the best
      parts of state-of-the-art tools and adds its own innovations.</p>
    <div class="my-16 grid grid-cols-3 gap-16">
      @foreach ($features as $feature)
        <div class="flex items-start gap-4">
          <div class="bg-primary-600 mt-1 h-8 w-8 shrink-0 rounded-full p-2">
            <x-dynamic-component class="h-4 w-4 text-white" :component="'icon.' . $feature['icon']" />
          </div>
          <div>
            <p class="text-lg font-semibold">{{ $feature['title'] }}</p>
            <p class="mt-2 leading-relaxed text-slate-500">{{ $feature['description'] }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </section>

  {{--  Brands  --}}
  <section class="bg-primary-600 my-24 rounded-lg">
    <div class="mx-auto max-w-7xl p-20">
      <div class="space-y-10">
        <h2 class="text-3xl font-bold tracking-tight text-white">The world's most innovative companies use our SaaS</h2>
        <div class="mt-0 flow-root">
          <div class="-mt-4 flex flex-wrap justify-between">
            @foreach ($brands as $brand)
              <div class="mt-4 flex flex-shrink-0 flex-grow-0">
                <x-dynamic-component class="text-primary-100/80 h-auto w-16" :component="'icon.' . $brand" />
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>

  {{--  Pricing  --}}
  <section class="mt-24 text-gray-800">
    <a id="pricing"></a>
    <p class="text-center text-5xl font-bold tracking-tight">Pricing plans for teams of all sizes</p>
    <p class="mt-4 text-center text-lg text-slate-600">Choose an affordable plan that's packed with the best features for
      engaging your audience, creating customer loyalty, and driving sales.</p>
    <div class="mx-auto my-16 grid max-w-7xl grid-cols-3 gap-x-8 space-y-0">
      @foreach ($plans as $plan)
        <div class="relative flex flex-col rounded-2xl border border-gray-200 bg-white p-8 shadow-sm">
          <div class="flex-1">
            <h3 class="text-xl font-semibold text-gray-900">{{ $plan['name'] }}</h3>
            <p class="mt-4 flex items-baseline text-gray-900">
              <span class="text-5xl font-bold tracking-tight">${{ $plan['price'] }}</span>
              <span class="ml-1 text-xl font-semibold">/month</span>
            </p>
            @if ($plan['popular'])
              <p
                class="bg-primary-500 absolute top-0 -translate-y-1/2 transform rounded-full px-4 py-1.5 text-sm font-semibold text-white">
                Most popular</p>
            @endif
            <p class="mt-6 text-gray-500">{{ $plan['description'] }}</p>

            {{--  Feature List  --}}
            <ul class="mt-6 space-y-6" role="list">
              @foreach ($plan['features'] as $feature)
                <li class="flex">
                  <x-icon.check class="text-primary-500 h-6 w-6 flex-shrink-0" />
                  <span class="ml-3 text-gray-500">{{ $feature }}</span>
                </li>
              @endforeach
            </ul>
          </div>

          <a href="{{ url('/sign-up') }}" @class([
              'mt-8 block w-full rounded-md border border-transparent py-3 px-6 text-center font-medium',
              'bg-primary-500 text-white hover:bg-primary-600' => $plan['popular'],
              'bg-primary-50 text-primary-700 hover:bg-primary-100' => !$plan['popular'],
          ])>
            Start your 7 day free trial</a>
        </div>
      @endforeach
    </div>
  </section>

  {{--  FAQ  --}}
  <section class="text-gray-800">
    <div class="mx-auto max-w-7xl px-6 py-16 lg:px-8 lg:py-20">
      <div class="lg:grid lg:grid-cols-3 lg:gap-8">
        <div class="space-y-4">
          <h2 class="text-3xl font-bold tracking-tight">Frequently asked questions</h2>
          <p class="text-lg text-gray-500">Can't find the answer you're looking for? Reach out to our <a
              class="text-primary-600 hover:text-primary-500 font-medium" href="#"
            >customer support</a> team.</p>
        </div>
        <div class="mt-12 lg:col-span-2 lg:mt-0">
          <dl class="space-y-12">
            @foreach ($faqs as $faq)
              <div>
                <dt class="text-lg font-medium leading-6">{{ $faq['question'] }}</dt>
                <dd class="mt-2 text-base text-gray-500">{{ $faq['answer'] }}</dd>
              </div>
            @endforeach
          </dl>
        </div>
      </div>
    </div>
  </section>
@endsection
