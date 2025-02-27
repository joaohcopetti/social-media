export interface Profile {
  // columns
  id: number
  user_id: number | null
  name: string
  slug: string
  photo: string
  thumbnail_photo: string
  description: string | null
  stripe_price_id: string | null
  created_at: string | null
  updated_at: string | null
  // mutators
  photo_url: string
  photo_thumb_url: string
  // relations
  media: ProfileMedia[]
  social_networks: SocialNetwork[]
  user: User
}

export interface ProfileMedia {
  // columns
  id: number
  profile_id: number
  description: string | null
  is_free: boolean
  show_on_home: boolean
  filename: string
  thumbnail_filename: string
  size: number
  order: number
  type: string
  created_at: string | null
  updated_at: string | null
  // mutators
  url: string
  thumbnail_url: string
  // relations
  profile: Profile
}

export interface SocialNetwork {
  // columns
  id: number
  name: string
  order: boolean
}

export interface Subscription {
  // columns
  id: number
  user_id: number
  profile_id: number | null
  type: string
  stripe_id: string
  stripe_status: string
  stripe_price: string | null
  quantity: number | null
  trial_ends_at: string | null
  ends_at: string | null
  created_at: string | null
  updated_at: string | null
  // relations
  profile: Profile
  owner: User
  items: SubscriptionItem[]
}

export interface User {
  // columns
  id: number
  name: string | null
  email: string
  email_verified_at: string | null
  password?: string
  remember_token?: string | null
  created_at: string | null
  updated_at: string | null
  stripe_id: string | null
  pm_type: string | null
  pm_last_four: string | null
  trial_ends_at: string | null
  // relations
  profile: Profile
  notifications: DatabaseNotification[]
  roles: Role[]
  permissions: Permission[]
  subscriptions: Subscription[]
}
