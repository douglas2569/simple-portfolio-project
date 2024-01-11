type Database =
{
  about:
  {
    id:string,
    photoCover:string,
    photoProfile:string,
    name: string,
    position: string,
    title: string,
    description: string,
    socialMedia:Array<SocialMedia>
  },
  settings:Array<Settings>
}

type SocialMedia =
  {
    id:string,
    name:string
  }

type Settings =
  {
    id:string,
    appName:string
  }

export {Database, SocialMedia, Settings}
