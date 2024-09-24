<template>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-slot="icon">
    <circle cx="4" cy="12" r="3" fill="currentColor">
      <animate id="fade0" fill="freeze" attributeName="opacity" begin="0;fade1.end-0.25s" dur="0.75s" values="1;0.2" />
    </circle>
    <circle cx="12" cy="12" r="3" fill="currentColor" opacity="0.4">
      <animate fill="freeze" attributeName="opacity" begin="fade0.begin+0.15s" dur="0.75s" values="1;0.2" />
    </circle>
    <circle cx="20" cy="12" r="3" fill="currentColor" opacity="0.3">
      <animate id="fade1" fill="freeze" attributeName="opacity" begin="fade0.begin+0.3s" dur="0.75s" values="1;0.2" />
    </circle>
  </svg>
</template>
