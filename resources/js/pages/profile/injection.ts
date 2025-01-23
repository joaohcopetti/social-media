import type { Profile } from '@/types/models'
import type { InjectionKey } from 'vue'

export const profileInjectionKey = Symbol() as InjectionKey<Profile>
