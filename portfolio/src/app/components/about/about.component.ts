import { Component, OnInit } from '@angular/core';
import { dataBase } from 'src/app/database';
import { Database, SocialMedia } from '../../models/database';
import { AboutService } from 'src/app/services/about.service';


@Component({
  selector: 'app-about',
  templateUrl: './about.component.html',
  styleUrls: ['./about.component.css']
})

export class AboutComponent implements OnInit {
  photoProfile!:string
  name!:string
  position!:string
  title!:string
  description!:string
  socialMedia!:Array<SocialMedia>

  constructor(private aboutService:AboutService) {
  }

  ngOnInit(): void {
    this.mount()
  }

  mount():void{
    this.aboutService.getAbout().subscribe((about)=>{
      this.photoProfile = about.data.profile_photo
      this.name = about.data.name
      this.position = about.data.profile_photo
      this.title = about.data.profile_photo
      this.description = about.data.profile_photo
      this.socialMedia = about.data.social_media
    })

    if(dataBase.about.photoProfile)
      this.photoProfile = dataBase.about.photoProfile
    else
      this.photoProfile = '../../../assets/images/profile-default.png'

    this.name = dataBase.about.name
    this.position = dataBase.about.position
    this.title = dataBase.about.title
    this.description = dataBase.about.description
    this.socialMedia = dataBase.about.socialMedia
  }

  // mount(dataBase:Database):void{
  //   if(dataBase.about.photoProfile)
  //     this.photoProfile = dataBase.about.photoProfile
  //   else
  //     this.photoProfile = '../../../assets/images/profile-default.png'

  //   this.name = dataBase.about.name
  //   this.position = dataBase.about.position
  //   this.title = dataBase.about.title
  //   this.description = dataBase.about.description
  //   this.socialMedia = dataBase.about.socialMedia
  // }
}
