import { ComputedRef, InjectionKey } from 'vue'

export const isProfileRouteInjectionKey = Symbol() as InjectionKey<ComputedRef<boolean>>
export const isGuestInjectionKey = Symbol() as InjectionKey<ComputedRef<boolean>>
