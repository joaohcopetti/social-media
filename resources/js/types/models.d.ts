export interface Profile {
  // columns
  id: number
  name: string
  slug: string
  photo: string
  thumbnail_photo: string
  description: string | null
  created_at: string | null
  updated_at: string | null
  // mutators
  photo_url: string
  // relations
  media: ProfileMedia[]
  social_networks: SocialNetwork[]
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

export interface User {
  // columns
  id: number
  name: string
  email: string
  email_verified_at: string | null
  password?: string
  is_admin: boolean
  remember_token?: string | null
  created_at: string | null
  updated_at: string | null
  // relations
  notifications: DatabaseNotification[]
  roles: Role[]
  permissions: Permission[]
}
