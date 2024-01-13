import { Component, OnInit } from '@angular/core';
import { ActivatedRoute} from '@angular/router';
import {dataBase} from '../../database'
import { Project } from '../../models/database';

@Component({   
  selector: 'app-project-content',
  templateUrl: './project-content.component.html',
  styleUrls: ['./project-content.component.css'],  
})

export class ProjectContentComponent implements OnInit {  
  project!:Project  
  apiLoaded:boolean = false

  constructor(private route:ActivatedRoute) { }

  ngOnInit(): void {    
    let id!:string | null
    this.route.paramMap.subscribe(value=> id = value.get('id')) 
    this.mount(id) 
    this.apiYoutubeLoaded()  
   
  }
  
  mount(id:string|null):void{
    this.project = dataBase.projects.filter((project)=>project.id == id)[0]
  }

  apiYoutubeLoaded():void{
    if (!this.apiLoaded) {
      const tag = document.createElement('script');
      tag.src = 'https://www.youtube.com/iframe_api';
      document.body.appendChild(tag);
      this.apiLoaded = true;
    }
  }

}
