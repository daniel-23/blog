<template>
    <div class="card-header">
        <h3 class="card-title">
            <slot name="title"></slot>
            <small v-if="!!$slots.description" class="text-muted"><slot name="description"></slot></small>
        </h3>
        <p v-if="!!$slots.aside"><slot name="aside"></slot></p>
    </div>
</template>
